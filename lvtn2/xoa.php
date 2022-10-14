<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lvtn2";
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
if ($conn->connect_error) {
    die("Connection fail: " . $conn->connect_error);
}
$MASP = $_GET['masp'];
$taikhoan = $_GET['taikhoan'];
$sql = "DELETE FROM giohang WHERE MASANPHAM='$MASP' AND TAIKHOAN = '$taikhoan'";
if ($conn->query($sql) == true) {
    header('Location: giohang.php');
} else {
    echo "error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
