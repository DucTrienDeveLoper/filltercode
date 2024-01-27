<?php
// Step 1: Connect to the Database
function connectToDatabase($servername, $username, $password, $database, $port) {
    $conn = mysqli_connect($servername, $username, $password, $database, $port);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Function to fetch data from a given query
function fetchData($conn, $query, $columnName) {
    $result = mysqli_query($conn, $query);
    $dataArray = [];
    while ($row = mysqli_fetch_array($result)) {
        $object = new stdClass();
        $object->tieude = $row[$columnName];
        $object->value = $row[$columnName];
        $dataArray[] = $object;
    }
    return $dataArray;
}

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "mobile";
$port = "3307";

// Connect to the database
$conn = connectToDatabase($servername, $username, $password, $database, $port);

// Query to get information from 'hang' table
$queryHang = "SELECT hangsp FROM hang";
$arrayHang = fetchData($conn, $queryHang, 'hangsp');

// Keyword for the query on 'sanpham' table
$keyword = "2";

// Query to get information from 'sanpham' table based on the keyword
$querySanPham = "SELECT tensp FROM `sanpham` WHERE hang = '$keyword'";
$arraySanPham = fetchData($conn, $querySanPham, 'tensp');

// Prepare the response object
$responseObject = new stdClass();
$responseObject->hang = $arrayHang;
$responseObject->sanpham = $arraySanPham;

// Encode the response object to JSON and echo
echo json_encode($responseObject);

// Close the database connection
mysqli_close($conn);
?>
