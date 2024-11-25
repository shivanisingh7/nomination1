<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = "localhost";
$username = "root";
$password = ""; // Set your database password
$dbname = "nomination_db";

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Determine which data to export based on the 'type' parameter
$type = $_GET['type'] ?? '';
if ($type === 'self') {
    $sql = "SELECT * FROM nominations WHERE nomination = 'yourself'";
    $filename = "nominating_yourself.csv";
} elseif ($type === 'someone') {
    $sql = "SELECT * FROM nominations WHERE nomination = 'someone_else'";
    $filename = "nominating_someone_else.csv";
} else {
    die("Invalid export type specified.");
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Set headers for download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . $filename);

// Open output stream
$output = fopen('php://output', 'w');

// Write column headers
if ($type === 'self') {
    fputcsv($output, ['Your Title', 'Your Name', 'Your Email', 'Your Phone', 'Your Role', 'Program', 'Graduation Year', 'Organisation', 'Designation', 'LinkedIn', 'Criteria', 'Testimonies File']);
} elseif ($type === 'someone') {
    fputcsv($output, ['Your Title', 'Your Name', 'Your Email', 'Your Phone', 'Your Role', 'Nominee Title', 'Nominee Name', 'Nominee Email', 'Nominee Phone', 'Program', 'Graduation Year', 'Organisation', 'Designation', 'LinkedIn', 'Nominee Documents']);
}

// Write data rows
while ($row = mysqli_fetch_assoc($result)) {
    if ($type === 'self') {
        fputcsv($output, [
            $row['your_title'], $row['your_name'], $row['your_email'], $row['your_phone'], $row['your_role'],
            $row['program'], $row['graduation_year'], $row['organisation'], $row['designation'],
            $row['linkedin'], $row['criteria'], $row['testimonies_file']
        ]);
    } elseif ($type === 'someone') {
        fputcsv($output, [
            $row['your_title'], $row['your_name'], $row['your_email'], $row['your_phone'], $row['your_role'],
            $row['nominee_title'], $row['nominee_name'], $row['nominee_email'], $row['nominee_phone'],
            $row['program'], $row['graduation_year'], $row['organisation'], $row['designation'],
            $row['linkedin'], $row['nominee_documents_file']
        ]);
    }
}

// Close output stream
fclose($output);
exit();
?>
