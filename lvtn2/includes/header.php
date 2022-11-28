<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (isset($_SESSION['taikhoan'])) {
    $taikhoan = $_SESSION['taikhoan'];
?>
    <header class="header header-intro-clearance header-3">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <a href="tel:#"><i class="icon-phone"></i>Liên hệ: +0944 928 214</a>
                </div>

                <div class="header-right">

                    <ul class="top-menu">
                        <li>
                            <a href="#"></a>
                            <ul>
                                <li></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="index.php" class="logo">
                        <img src="assets/images/demos/demo-3/ClickBuy-logo.png" alt="clickbuy Logo" width="105" height="25" style="background-color: white; border-radius: 50%;">
                    </a>
                </div>

                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <!-- <form action="./timkiem.php" method="get"> -->
                        <form action="" id="form" name="form" method="get">
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="tim" class="sr-only">Search</label>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                <input type="search" class="form-control" name="tim" id="tim" placeholder="Tìm sản phẩm" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="dropdown cart-dropdown ">
                    <a href="./giohang.php" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">
                                <?php
                                $sql_tongsptronggio = "SELECT DISTINCT * FROM GIOHANG, SANPHAM WHERE GIOHANG.MASANPHAM = SANPHAM.MASANPHAM AND HIENTHI = 1 AND TAIKHOAN = '$taikhoan'";
                                $res_tongsptronggio = Check_db($sql_tongsptronggio);
                                $num_rows = mysqli_num_rows($res_tongsptronggio);
                                if ($ktcon = mysqli_fetch_assoc($res_tongsptronggio)) {
                                    $kt_msp = $ktcon['MASANPHAM'];
                                    $kt_slsp = $ktcon['SOLUONGSANPHAM'];
                                    $kt_sql_hdn = "SELECT SUM(SOLUONGNHAP) FROM HOADONNHAP WHERE HOADONNHAP.MASANPHAM = '$kt_msp'";
                                    $kt_res_hdn = Check_db($kt_sql_hdn);
                                    $kt_sql_hdx = "SELECT SUM(SOLUONGSANPHAM) FROM HOADONXUAT WHERE HOADONXUAT.MASANPHAM = '$kt_msp'";
                                    $kt_res_hdx = Check_db($kt_sql_hdx);
                                    $kt_row1 = mysqli_fetch_array($kt_res_hdn);
                                    $kt_tongsoluongnhap = $kt_row1['SUM(SOLUONGNHAP)'];
                                    if (mysqli_num_rows($kt_res_hdx) > 0) {
                                        $kt_tongsoluongban = 0;
                                        while ($row2 = mysqli_fetch_array($kt_res_hdx)) {
                                            $kt_tongsoluongban = $kt_tongsoluongban + $row2['SUM(SOLUONGSANPHAM)'];
                                        }
                                        if ($kt_tongsoluongnhap - $kt_tongsoluongban > 0) {
                                            echo $num_rows;
                                        } else {
                                            echo 0;
                                        } 
                                    }
                                }
                                ?></span>
                        </div>
                        <p>Giỏ hàng</p>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="">
                            <?php
                            $sql_giohang = "SELECT DISTINCT * FROM GIOHANG, SANPHAM WHERE GIOHANG.MASANPHAM = SANPHAM.MASANPHAM AND TAIKHOAN = '$taikhoan' AND HIENTHI = 1";
                            $res_giohang = Check_db($sql_giohang);
                            while ($row_giohang = mysqli_fetch_assoc($res_giohang)) {
                                $msp = $row_giohang['MASANPHAM'];
                                $slsp = $row_giohang['SOLUONGSANPHAM'];
                                $giasp = $row_giohang['GIASANPHAM'];
                                $tensp = $row_giohang['TENSANPHAM'];
                                $sql_hdn = "SELECT SUM(SOLUONGNHAP) FROM HOADONNHAP WHERE HOADONNHAP.MASANPHAM = '$msp'";
                                $res_hdn = Check_db($sql_hdn);
                                $sql_hdx = "SELECT SUM(SOLUONGSANPHAM) FROM HOADONXUAT WHERE HOADONXUAT.MASANPHAM = '$msp'";
                                $res_hdx = Check_db($sql_hdx);
                                $row1 = mysqli_fetch_array($res_hdn);
                                $tongsoluongnhap = $row1['SUM(SOLUONGNHAP)'];
                                if (mysqli_num_rows($res_hdx) > 0) {
                                    $tongsoluongban = 0;
                                    while ($row2 = mysqli_fetch_array($res_hdx)) {
                                        $tongsoluongban = $tongsoluongban + $row2['SUM(SOLUONGSANPHAM)'];
                                    }
                                    if ($tongsoluongnhap - $tongsoluongban > 0) {
                            ?>
                                        <div class="">
                                            <div class="">
                                                <h4 class="product-title">
                                                    <a href="./xemthongtinsanpham.php?masanpham=', $msp, '"><?php echo $tensp ?></a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty"> x <?php echo $slsp ?></span>
                                                    <?php
                                                    $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$msp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                                                    $res_timmgg = Check_db($sql_timmgg);
                                                    if (mysqli_num_rows($res_timmgg) > 0) {
                                                        $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                        $giasaugiam = $giasp - $giasp * $row_timmgg['TILEGIAMGIA'] / 100;
                                                        echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                                    } else {
                                                        echo " <div class='product-price '>" . number_format($giasp, 0, '', ',') . " VND </div>";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </div>

                        <div class="dropdown-cart-action">
                            <a href="./giohang.php" class="btn btn-primary">Giỏ hàng</a>
                            <a href="./thanhtoan.php" class="btn btn-outline-primary-2"><span>Thanh toán</span><i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="header-bottom sticky-header">
            <div class="container">

                <div class="header-center">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container active">
                                <a href="index.php">Trang chủ</a>
                            </li>
                            <li>
                                <a href="./timkiem.php?tim=Chuot">aokhoac</a>
                            </li>
                            <li>
                                <a href="./timkiem.php?tim=BanPhim">Bàn phím</a>

                            </li>
                            <li>
                                <a href="./timkiem.php?tim=TaiNghe">Tai nghe</a>


                            </li>
                            <li>
                                <a href="./timkiem.php?tim=Loa">Loa</a>


                            </li>
                            <li>
                                <a href="./timkiem.php?tim=aokhoac">Áo khoác</a>

                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <a href="./trangcanhan.php">Trang cá nhân</a>
                </div>
            </div>
        </div>
    </header>
<?php
} else {
?>
    <header class="header header-intro-clearance header-3">
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <a href="tel:#"><i class="icon-phone"></i>Liên hệ: +84 0795 803 209</a>
                </div>

                <div class="header-right">

                    <ul class="top-menu">
                        <li>
                            <a href="#"></a>
                            <ul>
                                <li></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="header-middle">
            <div class="container">
                <div class="header-left">
                    <button class="mobile-menu-toggler">
                        <span class="sr-only">Toggle mobile menu</span>
                        <i class="icon-bars"></i>
                    </button>

                    <a href="index.php" class="logo">
                        <img src="assets/images/demos/demo-3/ClickBuy-logo.png" alt="clickbuy Logo" width="105" height="25" style="background-color: white; border-radius: 50%;">
                    </a>
                </div>

                <div class="header-center">
                    <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                        <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                        <form action="./timkiem.php" method="get">
                            <div class="header-search-wrapper search-wrapper-wide">
                                <label for="tim" class="sr-only">Search</label>
                                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                <input type="search" class="form-control" name="tim" id="tim" placeholder="Tìm sản phẩm" required>
                                
                            </div>
                            
                        </form>
                    </div>
                </div>
                <div class="dropdown cart-dropdown ">
                    <a href="./login.php" class="dropdown-toggle">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">0</span>
                        </div>
                        <p>Giỏ hàng</p>
                    </a>
                </div>
                
            </div>
        </div>
        
        </div>

        <div class="header-bottom sticky-header">
            <div class="container">

                <div class="header-center">
                    <nav class="main-nav">
                        <ul class="menu sf-arrows">
                            <li class="megamenu-container active">
                                <a href="index.php">Trang chủ</a>
                            </li>
                            <li>
                                <a href="./timkiem.php?tim=Chuot">ccccc</a>
                            </li>
                            <li>
                                <a href="./timkiem.php?tim=BanPhim">Bàn phím</a>
                            </li>
                            <li>
                                <a href="./timkiem.php?tim=TaiNghe">Tai nghe</a>
                            </li>
                            <li>
                                <a href="./timkiem.php?tim=Loa">Loa</a>
                            </li>
                            <li>
                                <a href="./timkiem.php?tim=CapSac">Cáp sạc</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <a href="./login.php">Trang cá nhân</a>
                </div>
            </div>
        </div>
    </header>
<?php
}
?>
<script>
    $( 'form' ).submit(function ( e ) {
    var data, xhr;

    data = new FormData();
    data.append( '#tim');

    xhr = new XMLHttpRequest();

    xhr.open( 'POST', 'http://hacheck.tel.fer.hr/xml.pl', true );
    xhr.onreadystatechange = function ( response ) {};
    xhr.send( data );

    e.preventDefault();
});
</script>