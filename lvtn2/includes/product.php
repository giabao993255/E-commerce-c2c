<?php 
    require_once('include.php');
    require_once('conn.php');


    function View_Discount_Of_Product($masp){
        $sql_discount = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND MASANPHAM = '$masp');";
        $res_discount = Check_db($sql_discount);
        if(mysqli_num_rows($res_discount) > 0){
            $row_discount = mysqli_fetch_assoc($res_discount);
            return $row_discount['TILEGIAMGIA'];
        }
        else{
            return 0;
        }
    }

    function Get_image($masp){
        $sql = "SELECT * FROM HINHANH WHERE MASP = '$masp'";
        $res = Check_db($sql);
        return $res;
    }
    function Filter_Ram($ram){
        $sql_ram = "SELECT * FROM SANPHAM WHERE RAM = '$ram'";
        $res = Check_db(($sql_ram));
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP']; 
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
                $motasp = $row['MOTASP'];
                $ngaysx = $row['NGAYSX'];
                $giam=$gia*(100-$phantram)/100;
                $hinh = Get_image($masp);

            }
        }
    }
    function Filter_Vixuly($vixuly){
        $sql_vixuly = "SELECT * FROM SANPHAM WHERE vixuly LIKE '%$vixuly%'";
        $res = Check_db($sql_vixuly);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP']; 
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
                $motasp = $row['MOTASP'];
                $ngaysx = $row['NGAYSX'];
                $giam=$gia*(100-$phantram)/100;
                $hinh = Get_image($masp);

            }
        }

    }
    function Filter_Nsx($mansx){

        $sql_mansx = "SELECT * FROM SANPHAM WHERE mansx = '$mansx'";
        $res = Check_db(($sql_mansx));
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP']; 
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
                $motasp = $row['MOTASP'];
                $ngaysx = $row['NGAYSX'];
                $giam=$gia*(100-$phantram)/100;
                $hinh = Get_image($masp);

            }
        }
    }
    function Filter_Kichthuocmh($kichthuocmh){
        $sql_kichthuocmh = "SELECT * FROM SANPHAM WHERE kichthuocmh LIKE '%$kichthuocmh%'";
        $res = Check_db($sql_kichthuocmh);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP']; 
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
                $motasp = $row['MOTASP'];
                $ngaysx = $row['NGAYSX'];
                $giam=$gia*(100-$phantram)/100;
                $hinh = Get_image($masp);

            }
        }

    }

    function View_Product_Discount(){
        $sql = "SELECT * FROM sanpham where MAGIAMGIA IS NOT NULL";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP'];
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
                $motasp = $row['MOTASP'];
                $ngaysx = $row['NGAYSX'];
                $giam=$gia*(100-$phantram)/100;
                echo   "
                <div class='card-group col-md-3 col-sm-6'>
                    <div class='card'>
                        <a href='./view.php?tenbien=$masp'>
                            <div class='card-header'>
                                <img src='./image/laptop.jpg' class='card-img-top' alt=''>
                            </div>
                            <div class='card-body'>
                                <h5 class='card-title'>".$tensp."</h5>
                                <p class='card-text'>".$ram."G ".$kichthuocmh."<br></p>
                                <p class='card-text'>".currency_format($giam,'đ')."</p>
                                <p class='card-text'>".currency_format($gia,'đ')."</p>
                                <p class='card-text'>-".$phantram."%</p>
                            </div>
                        </a>
                    </div>
                </div>";
            }
        }

    }
    
    function View_Full_Product(){
        $sql = "SELECT * FROM sanpham";
        $res = Check_db($sql);
        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
                $masp = $row['MASP'];
                $tensp = $row['TENSP'];
                $gia = $row['GIA'];
                $phantram = View_Discount_Of_Product($masp);
                $phantram = $row['PHANTRAM'];
                $kichthuocmh = $row['KICHTHUOCMH'];
                $vixuly = $row['VIXULY'];
                $ram = $row['RAM'];
            }
        }
        else{
            echo "khong tim duoc san pham nao";
        }
    }
 
    
?>