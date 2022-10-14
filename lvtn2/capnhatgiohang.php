<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');

$MASP = $_GET['masp'];
$taikhoan = $_SESSION['taikhoan'];
$slsp = $_GET['soluongsanpham'];
$sql = "UPDATE `giohang` SET `SOLUONGSANPHAM`='$slsp' WHERE `TAIKHOAN`='$taikhoan' AND `MASANPHAM`='$MASP' ";
if ($res = Check_db($sql)) {
    header('Location: giohang.php');
} else {
    echo "error: " . $sql . "<br>" . $conn->error;
}
