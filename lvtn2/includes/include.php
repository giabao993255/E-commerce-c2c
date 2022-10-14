<?php
    require_once('conn.php');
    
    function Pr($arr){
        echo "<pre>";
        print_r($arr);
    }

    function Prx($arr){
        echo "<pre>";
        print_r($arr);
        die();
    }

    function Check_db($sql){
        $conn = Connect();
        $res = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $res;
    }

    function Get_value($str){
        $conn = Connect();
        if($str != ""){
            return mysqli_real_escape_string($conn, $str);
        }
    }

    function Check_role_in_site($role){ 
        if($_SESSION['maquyen'] != $role){
            header('location: ./index.php');
        }
    }
?>