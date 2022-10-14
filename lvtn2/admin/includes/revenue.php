<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
?>

<?php
    function View_Full_Revenue(){
        $sql = "SELECT * FROM DONHANG";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res));
            $taikhoan = $row['TAIKHOAN'];
            $trangthai = $row['TRANGTHAI'];
            $ngaydat = $row['NGAYDAT'];
            $htthanhtoan = $row['HTTHANHTOAN'];
            $diachinhan = $row['DIACHINHAN'];
            $tongtien = $row['TONGTIEN'];
        }
        else{
            echo "khong co don hang nao";
        }
    }

    function Detail_Order($madh){
        $sql = "SELECT sanpham.MASP, sanpham.TENSP, sanpham.GIA, monhang.* FROM sanpham, monhang 
                WHERE sanpham.MASP = monhang.MASP AND monhang.MASP = '$madh'";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            while($row = mysqli_fetch_assoc($res));
            $madh = $row['MADH'];
            $masp = $row['MASP'];
            $tensp = $row['TENSP'];
            $gia = $row['GIA'];
            $soluongdat = $row['SOLUONGDAT'];
        }
        else{
            echo "don hang khong ton tai";
        }
    }

?>