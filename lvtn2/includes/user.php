<?php 
    require_once('./include.php');
    require_once('./conn.php');

    function Get_info($taikhoan){
        $sql_user = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan'";
        $res_user = Check_db($sql_user);
        if(mysqli_num_rows($res_user)){
            return $res_user;
        }
        else {
            return 0;
        }
    }
?>