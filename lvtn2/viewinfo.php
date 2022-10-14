
<?php
    require_once('includes/include.php');

    function View_Info($role){
        if($role=="AD"){
            header('location: ./index.php');
        }else{
            $taikhoan = $_SESSION['taikhoan'];
            $sql = "SELECT * FROM NGUOIDUNG  WHERE TAIKHOAN='$taikhoan'";  
            $res = Check_db($sql);
            $row = mysqli_fetch_assoc($res);
            $taikhoan = $row['TAIKHOAN'];
            $matkhau = $row['MATKHAU'];
            $gioitinh = $row['GIOITINH'];
            $tennd = $row['TENND'];
            $sdt = $row['SDT'];
            $diachi = $row['DIACHI'];
            $email = $row['EMAIL'];
            $ngaysinh = $row['NGAYSINH'];  
        }
    }


?>