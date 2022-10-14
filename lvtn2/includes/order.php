<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');

    function Get_Info_Account($taikhoan){
        $sql = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan'";
        $res = Check_db($sql);
        $row = mysqli_fetch_assoc($res);
        $tennd = $row['TENND'];
        $sdt = $row['SDT'];
        $diachi = $row['DIACHI'];
        $email = $row['EMAIL'];
        $ngaysinh = $row['NGAYSINH'];
        $thongtin = array('taikhoan'=>$taikhoan ,'tennd'=>$tennd, 'sdt'=>$sdt, 'diachi'=>$diachi, 'email'=>$email, 'ngaysinh'=>$ngaysinh);
        return $thongtin;
    }

    function Del_Cart($taikhoan){
        $sql = "DELETE FROM SANPHAMGIOHANG WHERE taikhoan = '$taikhoan'";
        $res = Check_db($sql);
    }

    function Get_Cart($taikhoan){
        $sql = "SELECT MASANPHAM, SOLUONGSANPHAM FROM GIOHANG WHERE taikhoan = '$taikhoan'";
        $res = Check_db($sql);
        return $res;
    }

    function Add_Product($madh, $monhang){
        while ($row = mysqli_fetch_assoc($monhang)) {
            $masp = $row['MASP'];
            $soluong = $row['SOLUONGGIO'];
            $sql = "INSERT INTO `donhang` (`MADH`, `MASP`, `SOLUONGDAT`)
                    VALUES (`$madh`, `$masp`, `$soluong`)";
            $res = Check_db($sql);
        }
    }
