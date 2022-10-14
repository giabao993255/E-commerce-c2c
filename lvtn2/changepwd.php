<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$taikhoan = $_SESSION['taikhoan'];
if (isset($_POST['dmk'])) {
    $mkc = md5($_POST['mkc']);
    $mkm = MD5($_POST['mkm']);
    $sql_dmk = "SELECT *FROM nguoidung where TAIKHOAN='$taikhoan' and MATKHAU='$mkc'";
    $res_dmk = Check_db($sql_dmk);
    if (mysqli_num_rows($res_dmk)) {
        $update_dmk = "UPDATE nguoidung SET MATKHAU='$mkm' WHERE TAIKHOAN='$taikhoan'";
        $res_mk = Check_db($update_dmk);
        if ($res_mk) {
            echo "<script>alert('Đổi mật khẩu thành công!')</script>";
            echo "<script>window.open('login.php','_self')</script>";
        } else {
            echo "<script>alert('Đổi mật khẩu không thành công!')</script>";
        }
    } else {
        echo "<script>alert('Mật khẩu cũ không đúng!')</script>";

    }
}
?>