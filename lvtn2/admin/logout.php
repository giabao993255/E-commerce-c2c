<?php
include_once('./includes/include.php');
session_destroy();
if (isset($_SESSION['taikhoan'])) {
    session_destroy();
    echo "<script>window.open('login.php','_self')</script>";
}
