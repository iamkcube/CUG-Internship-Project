<?php
require 'C:\xampp\htdocs\phpspreadsheet\vendor\autoload.php';
// Include PHPSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;

include 'db_connect.php'; // Assuming db_connect.php contains your database connection code

// Path to your Excel file
$excelFile = 'C:/Users/kalinga/Downloads/test_cug_data.xlsx';

// Load the Excel workbook
$spreadsheet = IOFactory::load($excelFile);

// Get the first sheet in the workbook
$sheet = $spreadsheet->getActiveSheet();
$highestRow = $sheet->getHighestRow();

// Loop through each row of the worksheet
for ($row = 2; $row <= $highestRow; $row++) { // Start from 2 to skip header row
    // Get row data as array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $sheet->getHighestColumn() . $row, NULL, TRUE, FALSE);

    // Prepare values for insertion
    $cug_number = $rowData[0][0];
    $emp_number = $rowData[0][1];
    $empname = $rowData[0][2];
    $designation = $rowData[0][3];
    $unit = $rowData[0][4];
    $department = $rowData[0][5];
    $bill_unit_no = $rowData[0][6];
    $allocation = $rowData[0][7];
    $operator = $rowData[0][8];
    $plan = $rowData[0][9];
    $status = $rowData[0][10];

    // Prepare the SQL statement
    $sql = "INSERT INTO cugdetails2 (cug_number, emp_number, empname, designation, unit, department, bill_unit_no, allocation, operator, plan, status) 
            VALUES ('$cug_number', '$emp_number', '$empname', '$designation', '$unit', '$department', '$bill_unit_no', '$allocation', '$operator', '$plan', '$status')";

    // Attempt to execute the SQL statement
    try {
        $result = $conn->query($sql);

        if ($result === TRUE) {
            echo "Record inserted successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    } catch (Exception $e) {
        // Handle any exceptions, such as duplicate key errors
		echo $sql;
        echo "Exception caught: " . $e->getMessage() . "<br>";
        continue; // Skip to the next iteration of the loop
    }
}

// Close the database connection
$conn->close();
?>
