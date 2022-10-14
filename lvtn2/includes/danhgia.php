<?php
require_once('./include.php');
require_once('./conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taikhoan = $_POST['taikhoan'];
    $diem = $_POST['rating'];
    $noidung = $_POST['noidung'];
    $masanpham = $_POST['masp'];
    $thoigian = Date('y-m-d');
    $sql_danhgia = "INSERT INTO `danhgia`(`MASANPHAM`, `TAIKHOAN`, `DIEMDANHGIA`, `NOIDUNG`, `THOIGIANDANHGIA`) VALUES ('$masanpham','$taikhoan','$diem','$noidung','$thoigian')";
    if($res_danhgia = Check_db($sql_danhgia)){
        echo "<script>window.open('./../xemthongtinsanpham.php?masanpham=" . $masanpham . "','_self')</script>";
        // echo $sql_danhgia;
    }
    
}