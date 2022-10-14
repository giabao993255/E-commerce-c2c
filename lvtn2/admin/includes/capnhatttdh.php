<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mdx = $_POST['madonxuat'];
    $sql_mdx = "UPDATE `hoadonxuat` SET `TRANGTHAI`='đã giao' WHERE MADONXUAT = '$mdx'";
    if($res_mdx = Check_db($sql_mdx)){
        echo "<script>window.open('./index.php?action=xemxuathang','_self')</script>";
        // echo $sql_mdx;
    }
    
}