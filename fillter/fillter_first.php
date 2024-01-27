<?php
    // step1: Connect Db
    $conn = mysqli_connect("localhost", "root", "", "mobile", "3307") or die();

    // query get infor from tables : 
    $queryHang = mysqli_query($conn, "SELECT hangsp FROM hang ");
    error_reporting(0);


    $arrayHang = array();

    $arraySanPham = array();
    
    if(mysqli_num_rows($queryHang)>0){
        while($row = mysqli_fetch_array($queryHang)){
            $objectHang = new stdClass();
            // array_push($array,$row['tensp']);
            // echo $row['tensp'];
            $objectHang->tieude = $row['hangsp'];
            $objectHang->value = $row['hangsp'];
            array_push($arrayHang,$objectHang);
        }
    }
    // echo $array;
 

    //
    $keyword = "2";
    $querySanPham = mysqli_query($conn,"SELECT tensp FROM `sanpham` WHERE hang = $keyword");
    error_reporting(0);
    if(mysqli_num_rows($querySanPham)>0){
        while($rows = mysqli_fetch_array($querySanPham)){
            $objectSanPham = new stdClass();
            $objectSanPham->tieude = $rows['tensp'];
            $objectSanPham->value = $rows['tensp'];
            array_push($arraySanPham,$objectSanPham);
        }
    }

    // 
    $object = new stdClass();
    $object->hang = $arrayHang;
    $object->sanpham = $arraySanPham;
    
    echo json_encode($object); 
       
  
?>
