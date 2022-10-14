<?php
 require_once('./includes/include.php');
require_once('./includes/conn.php');
    $taikhoan=$_GET['taikhoan'];
    $masp=$_GET['masp'];
    $soluonggio = $_GET['soluongsanpham'];
    $sql = "UPDATE giohang SET SOLUONGSANPHAM='$soluonggio' WHERE TAIKHOAN='$taikhoan' AND MASANPHAM='$masp'";
    if ($res = Check_db($sql)) {
        // echo "<script>window.open('giohang.php','_self')</script>";
        echo $sql;
    } else {
        echo "<script>alert('Cập nhật thất bại')</script>";
    }

?>