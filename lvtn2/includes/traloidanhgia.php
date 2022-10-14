<?php
require_once('./include.php');
require_once('./conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masanpham = $_POST['masanpham'];
    $taikhoan = $_POST['taikhoan'];
    $noidung = $_POST['noidung'];
    $madanhgia = $_POST['madanhgia'];
    $thoigian = Date('y-m-d');
    $sql_danhgia = "INSERT INTO `traloidanhgia`(`MADANHGIA`, `TAIKHOAN`, `NOIDUNGTRALOI`, `THOIGIANTRALOI`) VALUES ('$madanhgia','$taikhoan','$noidung','$thoigian')";
    if($res_danhgia = Check_db($sql_danhgia)){
        echo "<script>window.open('./../xemthongtinsanpham.php?masanpham=" . $masanpham . "','_self')</script>";
    }
}