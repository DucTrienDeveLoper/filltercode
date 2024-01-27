<?php
// Step 1: Connect to the Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "mobile";
$port = "3307";

$conn = mysqli_connect($servername, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to get information from 'hang' table
$queryHang = mysqli_query($conn, "SELECT hangsp FROM hang");

$arrayHang = [];
$arraySanPham = [];

// Fetch data from 'hang' table
while ($row = mysqli_fetch_array($queryHang)) {
    $objectHang = new stdClass();
    $objectHang->tieude = $row['hangsp'];
    $objectHang->value = $row['hangsp'];
    $arrayHang[] = $objectHang;
}

// Keyword for the query on 'sanpham' table
$keyword = "2";

// Query to get information from 'sanpham' table based on the keyword
$querySanPham = mysqli_query($conn, "SELECT tensp FROM `sanpham` WHERE hang = '$keyword'");

// Fetch data from 'sanpham' table
while ($rows = mysqli_fetch_array($querySanPham)) {
    $objectSanPham = new stdClass();
    $objectSanPham->tieude = $rows['tensp'];
    $objectSanPham->value = $rows['tensp'];
    $arraySanPham[] = $objectSanPham;
}

// Prepare the response object
$responseObject = new stdClass();
$responseObject->hang = $arrayHang;
$responseObject->sanpham = $arraySanPham;

// Encode the response object to JSON and echo
echo json_encode($responseObject);

// Close the database connection
mysqli_close($conn);
?>
