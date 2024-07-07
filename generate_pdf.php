<?php
require('fpdf186/fpdf.php'); // Ensure the path to fpdf.php is correct
include 'db_connect.php';

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30, 10, 'Allocation Report', 0, 1, 'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Load data
    function LoadData($conn)
    {
        $query = "
            SELECT 
                c.allocation,
                GROUP_CONCAT(DISTINCT CONCAT(b.bill_month, '-', b.bill_year) ORDER BY b.bill_year, b.bill_month ASC SEPARATOR ', ') AS bill_dates,
                SUM(b.periodic_charge + b.usage_amount + b.data_amount + b.voice + b.video + b.sms + b.vas) AS total_amount
            FROM 
                cugdetails c
            JOIN 
                bills b ON c.cug_number = b.cug_number
            GROUP BY 
                c.allocation
            ORDER BY 
                c.allocation;
        ";

        $result = $conn->query($query);
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    // Table
    function BasicTable($header, $data, $cgst_percentage, $sgst_percentage)
    {
        // Header
        foreach ($header as $col) {
            $this->Cell(60, 7, $col, 1);
        }
        $this->Ln();
        
        // Data
        $grand_total_amount = 0;
        foreach ($data as $row) {
            $total_amount = $row['total_amount'];
            $grand_total_amount += $total_amount;

            $this->Cell(60, 6, $row['allocation'], 1);
            $this->Cell(60, 6, $row['bill_dates'], 1);
            $this->Cell(60, 6, 'Rs. ' . number_format($total_amount, 2), 1);
            $this->Ln();
        }

        // Calculate CGST and SGST
        $grand_total_cgst = ($grand_total_amount * $cgst_percentage) / 100;
        $grand_total_sgst = ($grand_total_amount * $sgst_percentage) / 100;
        $grand_total_payable = $grand_total_amount + $grand_total_cgst + $grand_total_sgst;

        // Display grand total, CGST, SGST, and total payable
        $this->Ln();
        $this->Cell(120, 6, 'Grand Total', 1);
        $this->Cell(60, 6, 'Rs. ' . number_format($grand_total_amount, 2), 1);
        $this->Ln();
        $this->Cell(120, 6, 'CGST', 1);
        $this->Cell(60, 6, 'Rs. ' . number_format($grand_total_cgst, 2), 1);
        $this->Ln();
        $this->Cell(120, 6, 'SGST', 1);
        $this->Cell(60, 6, 'Rs. ' . number_format($grand_total_sgst, 2), 1);
        $this->Ln();
        $this->Cell(120, 6, 'Total Amount Payable', 1);
        $this->Cell(60, 6, 'Rs. ' . number_format($grand_total_payable, 2), 1);
    }
}

$pdf = new PDF();
// Column headings
$header = ['Allocation', 'Bill Dates', 'Amount'];
// Fetch GST percentages
$gst_query = "SELECT cgst_percentage, sgst_percentage FROM gst LIMIT 1";
$gst_result = $conn->query($gst_query);
$gst_data = $gst_result->fetch_assoc();
$cgst_percentage = $gst_data['cgst_percentage'];
$sgst_percentage = $gst_data['sgst_percentage'];
// Data loading
$data = $pdf->LoadData($conn);
$pdf->SetFont('Arial', '', 12);
$pdf->AddPage();
$pdf->BasicTable($header, $data, $cgst_percentage, $sgst_percentage);
$pdf->Output('D', 'allocation_report.pdf');

// Close database connection
$conn->close();
?>
