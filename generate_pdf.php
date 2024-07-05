<?php
require('fpdf186/fpdf.php'); // Ensure the path to fpdf.php is correct
include 'db_connect.php';

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Remove or comment out the logo line
        // $this->Image('logo.jpg', 10, 6, 30);
        
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
                GROUP_CONCAT(DISTINCT b.bill_date ORDER BY b.bill_date ASC SEPARATOR ', ') as bill_dates,
                SUM(b.periodic_charge + b.usage_amount + b.data_amount + b.voice + b.video + b.sms + b.vas) as total_amount
            FROM 
                cugdetails c
            JOIN 
                bills b ON c.cug_id = b.cug_id
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
    function BasicTable($header, $data)
    {
        // Header
        foreach ($header as $col) {
            $this->Cell(60, 7, $col, 1);
        }
        $this->Ln();
        // Data
        foreach ($data as $row) {
            $this->Cell(60, 6, $row['allocation'], 1);
            $this->Cell(60, 6, $row['bill_dates'], 1);
            $this->Cell(60, 6, 'Rs. ' . number_format($row['total_amount'], 2), 1);
            $this->Ln();
        }
    }
}

$pdf = new PDF();
// Column headings
$header = ['Allocation', 'Bill Dates', 'Amount'];
// Data loading
$data = $pdf->LoadData($conn);
$pdf->SetFont('Arial', '', 12);
$pdf->AddPage();
$pdf->BasicTable($header, $data);
$pdf->Output('D', 'allocation_report.pdf');

// Close database connection
$conn->close();
?>
