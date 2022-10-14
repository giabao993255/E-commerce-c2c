<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>

<body>
    <!-- header -->
    <?php include('./includes/header.php') ?>
    <!-- banner -->
    <main class="main">
        <div class="intro-section pt-3 pb-3 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="intro-slider-container slider-container-ratio mb-2 mb-lg-0">
                            <div class="banner mb-lg-1 mb-xl-2">
                                <?php
                                $sql_moinhat = "SELECT *, DATE(THOIGIANHIENTHI) as thoigianhien FROM sanpham ORDER BY THOIGIANHIENTHI DESC";
                                $res_moinhat = Check_db($sql_moinhat);
                                $row_moinhat = mysqli_fetch_assoc($res_moinhat);
                                $maspmoinhat = $row_moinhat['MASANPHAM'];
                                $tenspmoinhat = $row_moinhat['TENSANPHAM'];
                                ?>
                                <a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspmoinhat ?>">
                                    <?php
                                    $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$maspmoinhat'";
                                    $res_img = Check_db($sql_img);
                                    $row = mysqli_fetch_assoc($res_img);
                                    $duongdan = $row['DUONGDAN'];
                                    ?>
                                    <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                </a>

                                <div class="banner-content">
                                    <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspmoinhat ?>">Sản phẩm mới nhất</a></h4>
                                    <h3 class="banner-title"><a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspmoinhat ?>"><?php echo $tenspmoinhat ?></a></h3>
                                    <a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspmoinhat ?>" class="banner-link">Xem ngay<i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="intro-banners">
                            <div class="banner mb-lg-1 mb-xl-2">
                                <?php
                                $sql_banchaynhat = "SELECT sp.MASANPHAM, sp.TENSANPHAM, SUM(soluongsanpham) AS tongsl, sp.GIASANPHAM
                                FROM sanpham sp, hoadonxuat hdx WHERE sp.MASANPHAM = hdx.MASANPHAM GROUP BY hdx.MASANPHAM ORDER BY tongsl DESC";
                                $res_banchaynhat = Check_db($sql_banchaynhat);
                                $row_banchaynhat = mysqli_fetch_assoc($res_banchaynhat);
                                $maspbanchaynhat = $row_banchaynhat['MASANPHAM'];
                                $tenspbanchaynhat = $row_banchaynhat['TENSANPHAM'];
                                ?>
                                <a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspbanchaynhat ?>">
                                    <?php
                                    $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$maspbanchaynhat'";
                                    $res_img = Check_db($sql_img);
                                    $row = mysqli_fetch_assoc($res_img);
                                    $duongdan = $row['DUONGDAN'];
                                    ?>
                                    <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                </a>

                                <div class="banner-content">
                                    <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspbanchaynhat ?>">Bán chạy nhất</a></h4>
                                    <h3 class="banner-title"><a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspbanchaynhat ?>"><?php echo $tenspbanchaynhat ?></a></h3>
                                    <a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspbanchaynhat ?>" class="banner-link">Xem ngay<i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>

                            <div class="banner mb-lg-1 mb-xl-2">
                                <?php
                                $sql_giamgianhieunhat = "SELECT * FROM SANPHAM, GIAMGIA WHERE SANPHAM.MAGIAMGIA = GIAMGIA.MAGIAMGIA AND now() BETWEEN thoigianapdung AND thoigianketthuc ORDER BY TILEGIAMGIA DESC";
                                $res_giamgianhieunhat = Check_db($sql_giamgianhieunhat);
                                $row_giamgianhieunhat = mysqli_fetch_assoc($res_giamgianhieunhat);
                                $maspgiamgianhieunhat = $row_giamgianhieunhat['MASANPHAM'];
                                $tenspgiamgianhieunhat = $row_giamgianhieunhat['TENSANPHAM'];
                                $tilegiamgianhieunhat = $row_giamgianhieunhat['TILEGIAMGIA'];
                                ?>
                                <a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspgiamgianhieunhat ?>">
                                    <?php
                                    $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$maspgiamgianhieunhat'";
                                    $res_img = Check_db($sql_img);
                                    $row = mysqli_fetch_assoc($res_img);
                                    $duongdan = $row['DUONGDAN'];
                                    ?>
                                    <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                </a>

                                <div class="banner-content">
                                    <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspgiamgianhieunhat ?>">Giảm giá nhiều nhất</a></h4>
                                    <h3 class="banner-title"><a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspgiamgianhieunhat ?>"><?php echo $tenspgiamgianhieunhat ?> <span>Giảm <?php echo $tilegiamgianhieunhat ?>%</span></a></h3>
                                    <a href="./xemthongtinsanpham.php?masanpham=<?php echo $maspgiamgianhieunhat ?>" class="banner-link">Xem ngay<i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <hr class="mt-3 mb-6">
        </div>

        <div class="container">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title" id="moi">Sản phẩm mới</h2>
                </div>
            </div>

            <div class="row">
                <?php
                $sql = "SELECT * FROM sanpham WHERE HIENTHI = 1 ORDER BY SANPHAM.THOIGIANHIENTHI DESC";
                $res = Check_db($sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $masp = $row['MASANPHAM'];
                    $tensp = $row['TENSANPHAM'];
                    $gia = $row['GIASANPHAM'];
                    $sql_hdn = "SELECT SUM(SOLUONGNHAP) FROM HOADONNHAP WHERE HOADONNHAP.MASANPHAM = '$masp'";
                    $res_hdn = Check_db($sql_hdn);
                    $sql_hdx = "SELECT SUM(SOLUONGSANPHAM) FROM HOADONXUAT WHERE HOADONXUAT.MASANPHAM = '$masp'";
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
                            <div class='col-md-2 col-sm-6 d-inline-flex'>
                                <div class='card product product-2'>
                                    <a href='./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>'>
                                        <div class='card-header product-media'>
                                            <?php
                                            $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                            $res_img = Check_db($sql_img);
                                            $row = mysqli_fetch_assoc($res_img);
                                            $duongdan = $row['DUONGDAN'];
                                            ?>
                                            <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                            <span class="product-label label-circle label-top">Mới</span>
                                        </div>
                                        <div class='card-body'>
                                            <h4 class='card-title'><?php echo $tensp ?></h4>
                                            <div class="">
                                                <?php
                                                $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN thoigianapdung AND thoigianketthuc";
                                                $res_timmgg = Check_db($sql_timmgg);
                                                if (mysqli_num_rows($res_timmgg) > 0) {
                                                    $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                    $giasaugiam = $gia - $gia * $row_timmgg['TILEGIAMGIA'] / 100;
                                                    echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                                } else {
                                                    echo " <div class='product-price '>" . number_format($gia, 0, '', ',') . " VND </div>";
                                                }
                                                ?>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 
                                                    <?php
                                                    $sql_rating = "SELECT SUM(DIEMDANHGIA), COUNT(DIEMDANHGIA) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    if ($row['COUNT(DIEMDANHGIA)'] != 0) {
                                                        echo $row['SUM(DIEMDANHGIA)'] / $row['COUNT(DIEMDANHGIA)'] * 20;
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%;"></div>
                                                </div>
                                                <span class="ratings-text">(
                                                    <?php
                                                    $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    echo $row['COUNT(MASANPHAM)'];
                                                    ?>
                                                    Đánh giá )
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class='col-md-2 col-sm-6 d-inline-flex'>
                            <div class='card product product-2'>
                                <a href='./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>'>
                                    <div class='card-header product-media'>
                                        <?php
                                        $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                        $res_img = Check_db($sql_img);
                                        $row = mysqli_fetch_assoc($res_img);
                                        $duongdan = $row['DUONGDAN'];
                                        ?>
                                        <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                        <span class="product-label label-circle label-top">Mới</span>
                                    </div>
                                    <div class='card-body'>
                                        <h4 class='card-title'><?php echo $tensp ?></h4>
                                        <div class="">
                                            <?php
                                            $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN thoigianapdung AND thoigianketthuc";
                                            $res_timmgg = Check_db($sql_timmgg);
                                            if (mysqli_num_rows($res_timmgg) > 0) {
                                                $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                $giasaugiam = $gia - $gia * $row_timmgg['TILEGIAMGIA'] / 100;
                                                echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                            } else {
                                                echo " <div class='product-price '>" . number_format($gia, 0, '', ',') . " VND </div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 
                                                    <?php
                                                    $sql_rating = "SELECT SUM(DIEMDANHGIA), COUNT(DIEMDANHGIA) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    if ($row['COUNT(DIEMDANHGIA)'] != 0) {
                                                        echo $row['SUM(DIEMDANHGIA)'] / $row['COUNT(DIEMDANHGIA)'] * 20;
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%;"></div>
                                            </div>
                                            <span class="ratings-text">(
                                                <?php
                                                $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                $res_rating = Check_db($sql_rating);
                                                $row = mysqli_fetch_assoc($res_rating);
                                                echo $row['COUNT(MASANPHAM)'];
                                                ?>
                                                Đánh giá )
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="container">
            <hr class="mt-5 mb-6">
        </div>

        <div class="container top">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title" id="banchay">Sản phẩm bán chạy</h2>
                </div>
            </div>
            <div class="row">
                <?php
                $sql = "SELECT sp.MASANPHAM, sp.TENSANPHAM, SUM(soluongsanpham) AS tongsl, sp.GIASANPHAM
            FROM sanpham sp, hoadonxuat hdx WHERE sp.MASANPHAM = hdx.MASANPHAM AND sp.HIENTHI = 1 GROUP BY hdx.MASANPHAM ORDER BY tongsl DESC";
                $res = Check_db($sql);
                while ($row = mysqli_fetch_array($res)) {
                    $masp = $row['MASANPHAM'];
                    $tongsoluongban = $row['tongsl'];
                    $tensp = $row['TENSANPHAM'];
                    $gia = $row['GIASANPHAM'];
                    $sql_hdn = "SELECT SUM(SOLUONGNHAP) FROM HOADONNHAP WHERE HOADONNHAP.MASANPHAM = '$masp'";
                    $res_hdn = Check_db($sql_hdn);
                    $sql_hdx = "SELECT SUM(SOLUONGSANPHAM) FROM HOADONXUAT WHERE HOADONXUAT.MASANPHAM = '$masp'";
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
                            <div class='col-md-2 col-sm-6 d-inline-flex'>
                                <div class='card product product-2'>
                                    <a href='./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>'>
                                        <div class='card-header product-media'>
                                            <?php
                                            $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                            $res_img = Check_db($sql_img);
                                            $row = mysqli_fetch_assoc($res_img);
                                            $duongdan = $row['DUONGDAN'];
                                            ?>
                                            <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                            <span class="product-label label-circle label-top">Bán <?php echo $tongsoluongban ?></span>
                                        </div>
                                        <div class='card-body'>
                                            <h4 class='card-title'><?php echo $tensp ?></h4>
                                            <div class="ratings-container">
                                                <div class="">
                                                    <?php
                                                    $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                                                    $res_timmgg = Check_db($sql_timmgg);
                                                    if (mysqli_num_rows($res_timmgg) > 0) {
                                                        $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                        $giasaugiam = $gia - $gia * $row_timmgg['TILEGIAMGIA'] / 100;
                                                        echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                                    } else {
                                                        echo " <div class='product-price '>" . number_format($gia, 0, '', ',') . " VND </div>";
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 
                                                    <?php
                                                    $sql_rating = "SELECT SUM(DIEMDANHGIA), COUNT(DIEMDANHGIA) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    if ($row['COUNT(DIEMDANHGIA)'] != 0) {
                                                        echo $row['SUM(DIEMDANHGIA)'] / $row['COUNT(DIEMDANHGIA)'] * 20;
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%;"></div>
                                                </div>
                                                <span class="ratings-text">(
                                                    <?php
                                                    $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    echo $row['COUNT(MASANPHAM)'];
                                                    ?>
                                                    Đánh giá )</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class='col-md-2 col-sm-6 d-inline-flex'>
                            <div class='card product product-2'>
                                <a href='./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>'>
                                    <div class='card-header product-media'>
                                        <?php
                                        $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                        $res_img = Check_db($sql_img);
                                        $row = mysqli_fetch_assoc($res_img);
                                        $duongdan = $row['DUONGDAN'];
                                        ?>
                                        <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                        <span class="product-label label-circle label-top">Bán <?php echo $tongsoluongban ?></span>
                                    </div>
                                    <div class='card-body'>
                                        <h4 class='card-title'><?php echo $tensp ?></h4>
                                        <div class="ratings-container">
                                            <div class="">
                                                <?php
                                                $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                                                $res_timmgg = Check_db($sql_timmgg);
                                                if (mysqli_num_rows($res_timmgg) > 0) {
                                                    $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                    $giasaugiam = $gia - $gia * $row_timmgg['TILEGIAMGIA'] / 100;
                                                    echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                                } else {
                                                    echo " <div class='product-price '>" . number_format($gia, 0, '', ',') . " VND </div>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 
                                                    <?php
                                                    $sql_rating = "SELECT SUM(DIEMDANHGIA), COUNT(DIEMDANHGIA) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    if ($row['COUNT(DIEMDANHGIA)'] == 0) {
                                                        echo $row['SUM(DIEMDANHGIA)'] / $row['COUNT(DIEMDANHGIA)'] * 20;
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%;"></div>
                                            </div>
                                            <span class="ratings-text">(
                                                <?php
                                                $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                $res_rating = Check_db($sql_rating);
                                                $row = mysqli_fetch_assoc($res_rating);
                                                echo $row['COUNT(MASANPHAM)'];
                                                ?>
                                                Đánh giá )</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="container">
            <hr class="mt-5 mb-6">
        </div>

        <div class="container top">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title" id="giamgia">Sản phẩm giảm giá</h2>
                </div>
            </div>
            <div class="row">
                <?php
                $sql = "SELECT * FROM SANPHAM, GIAMGIA WHERE SANPHAM.MAGIAMGIA = GIAMGIA.MAGIAMGIA AND HIENTHI = 1 AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc ORDER BY TILEGIAMGIA DESC";
                $res = Check_db($sql);
                while ($row = mysqli_fetch_assoc($res)) {
                    $masp = $row['MASANPHAM'];
                    $tensp = $row['TENSANPHAM'];
                    $gia = $row['GIASANPHAM'];
                    $tilegiamgia = $row['TILEGIAMGIA'];
                    $sql_hdn = "SELECT SUM(SOLUONGNHAP) FROM HOADONNHAP WHERE HOADONNHAP.MASANPHAM = '$masp'";
                    $res_hdn = Check_db($sql_hdn);
                    $sql_hdx = "SELECT SUM(SOLUONGSANPHAM) FROM HOADONXUAT WHERE HOADONXUAT.MASANPHAM = '$masp'";
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
                            <div class='col-md-2 col-sm-6 d-inline-flex'>
                                <div class='card product product-2'>
                                    <a href='./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>'>
                                        <div class='card-header product-media'>
                                            <?php
                                            $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                            $res_img = Check_db($sql_img);
                                            $row = mysqli_fetch_assoc($res_img);
                                            $duongdan = $row['DUONGDAN'];
                                            ?>
                                            <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                            <span class="product-label label-circle label-top">Giảm <?php echo $tilegiamgia ?>%</span>
                                        </div>
                                        <div class='card-body'>
                                            <h4 class='card-title'><?php echo $tensp ?></h4>
                                            <div class="">
                                                <?php
                                                $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                                                $res_timmgg = Check_db($sql_timmgg);
                                                if (mysqli_num_rows($res_timmgg) > 0) {
                                                    $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                    $giasaugiam = $gia - $gia * $row_timmgg['TILEGIAMGIA'] / 100;
                                                    echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                                } else {
                                                    echo " <div class='product-price '>" . number_format($gia, 0, '', ',') . " VND </div>";
                                                }
                                                ?>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 
                                                    <?php
                                                    $sql_rating = "SELECT SUM(DIEMDANHGIA), COUNT(DIEMDANHGIA) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    if ($row['COUNT(DIEMDANHGIA)'] != 0) {
                                                        echo $row['SUM(DIEMDANHGIA)'] / $row['COUNT(DIEMDANHGIA)'] * 20;
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%;"></div>
                                                </div>
                                                <span class="ratings-text">(
                                                    <?php
                                                    $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    echo $row['COUNT(MASANPHAM)'];
                                                    ?>
                                                    Đánh giá )
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php
                        }
                    } else {
                        ?>
                        <div class='col-md-2 col-sm-6 d-inline-flex'>
                            <div class='card product product-2'>
                                <a href='./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>'>
                                    <div class='card-header product-media'>
                                        <?php
                                        $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                        $res_img = Check_db($sql_img);
                                        $row = mysqli_fetch_assoc($res_img);
                                        $duongdan = $row['DUONGDAN'];
                                        ?>
                                        <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                        <span class="product-label label-circle label-top">Giảm <?php echo $tilegiamgia ?>%</span>
                                    </div>
                                    <div class='card-body'>
                                        <h4 class='card-title'><?php echo $tensp ?></h4>
                                        <div class="">
                                            <?php
                                            $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                                            $res_timmgg = Check_db($sql_timmgg);
                                            if (mysqli_num_rows($res_timmgg) > 0) {
                                                $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                $giasaugiam = $gia - $gia * $row_timmgg['TILEGIAMGIA'] / 100;
                                                echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                            } else {
                                                echo " <div class='product-price '>" . number_format($gia, 0, '', ',') . " VND </div>";
                                            }
                                            ?>
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 
                                                    <?php
                                                    $sql_rating = "SELECT SUM(DIEMDANHGIA), COUNT(DIEMDANHGIA) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                    $res_rating = Check_db($sql_rating);
                                                    $row = mysqli_fetch_assoc($res_rating);
                                                    if ($row['COUNT(DIEMDANHGIA)'] != 0) {
                                                        echo $row['SUM(DIEMDANHGIA)'] / $row['COUNT(DIEMDANHGIA)'] * 20;
                                                    } else {
                                                        echo 0;
                                                    }
                                                    ?>%;"></div>
                                            </div>
                                            <span class="ratings-text">(
                                                <?php
                                                $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                                $res_rating = Check_db($sql_rating);
                                                $row = mysqli_fetch_assoc($res_rating);
                                                echo $row['COUNT(MASANPHAM)'];
                                                ?>
                                                Reviews )</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="container">
            <hr class="mt-5 mb-0">
        </div>


        <div class="icon-boxes-container mt-2 mb-2 bg-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-rocket"></i>
                            </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Miễn phí giao hàng</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-rotate-left"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Hoàn tiền</h3>
                                <p>Trong 30 ngày</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4">
                        <div class="icon-box icon-box-side">
                            <span class="icon-box-icon text-dark">
                                <i class="icon-life-ring"></i>
                            </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Hỗ trợ</h3>
                                <p>24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="cta cta-separator cta-border-image cta-half mb-0" style="background-image: url(assets/images/demos/demo-3/bg-2.jpg);">
                <div class="cta-border-wrapper bg-white">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cta-wrapper cta-text text-center">
                                <h3 class="cta-title">Mạng xã hội</h3>
                                <p class="cta-desc">Theo dõi chúng tôi ở các kênh mạng xã hội</p>

                                <div class="social-icons social-icons-colored justify-content-center">
                                    <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                                    <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="cta-wrapper text-center">
                                <h3 class="cta-title">Nhận thông tin về sản phẩm mới</h3>
                                <form action="#">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Email của bạn" aria-label="Email Adress" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary btn-rounded" type="submit"><i class="icon-long-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="index.html">Home</a>

                                <ul>
                                    <li><a href="index-1.html">01 - furniture store</a></li>
                                    <li><a href="index-2.html">02 - furniture store</a></li>
                                    <li><a href="index-3.html">03 - electronic store</a></li>
                                    <li><a href="index-4.html">04 - electronic store</a></li>
                                    <li><a href="index-5.html">05 - fashion store</a></li>
                                    <li><a href="index-6.html">06 - fashion store</a></li>
                                    <li><a href="index-7.html">07 - fashion store</a></li>
                                    <li><a href="index-8.html">08 - fashion store</a></li>
                                    <li><a href="index-9.html">09 - fashion store</a></li>
                                    <li><a href="index-10.html">10 - shoes store</a></li>
                                    <li><a href="index-11.html">11 - furniture simple store</a></li>
                                    <li><a href="index-12.html">12 - fashion simple store</a></li>
                                    <li><a href="index-13.html">13 - market</a></li>
                                    <li><a href="index-14.html">14 - market fullwidth</a></li>
                                    <li><a href="index-15.html">15 - lookbook 1</a></li>
                                    <li><a href="index-16.html">16 - lookbook 2</a></li>
                                    <li><a href="index-17.html">17 - fashion store</a></li>
                                    <li><a href="index-18.html">18 - fashion store (with sidebar)</a></li>
                                    <li><a href="index-19.html">19 - games store</a></li>
                                    <li><a href="index-20.html">20 - book store</a></li>
                                    <li><a href="index-21.html">21 - sport store</a></li>
                                    <li><a href="index-22.html">22 - tools store</a></li>
                                    <li><a href="index-23.html">23 - fashion left navigation store</a></li>
                                    <li><a href="index-24.html">24 - extreme sport store</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="category.html">Shop</a>
                                <ul>
                                    <li><a href="category-list.html">Shop List</a></li>
                                    <li><a href="category-2cols.html">Shop Grid 2 Columns</a></li>
                                    <li><a href="category.html">Shop Grid 3 Columns</a></li>
                                    <li><a href="category-4cols.html">Shop Grid 4 Columns</a></li>
                                    <li><a href="category-boxed.html"><span>Shop Boxed No Sidebar<span class="tip tip-hot">Hot</span></span></a></li>
                                    <li><a href="category-fullwidth.html">Shop Fullwidth No Sidebar</a></li>
                                    <li><a href="product-category-boxed.html">Product Category Boxed</a></li>
                                    <li><a href="product-category-fullwidth.html"><span>Product Category Fullwidth<span class="tip tip-new">New</span></span></a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="#">Lookbook</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="product.html" class="sf-with-ul">Product</a>
                                <ul>
                                    <li><a href="product.html">Default</a></li>
                                    <li><a href="product-centered.html">Centered</a></li>
                                    <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li>
                                    <li><a href="product-gallery.html">Gallery</a></li>
                                    <li><a href="product-sticky.html">Sticky Info</a></li>
                                    <li><a href="product-sidebar.html">Boxed With Sidebar</a></li>
                                    <li><a href="product-fullwidth.html">Full Width</a></li>
                                    <li><a href="product-masonry.html">Masonry Sticky Info</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                                <ul>
                                    <li>
                                        <a href="about.html">About</a>

                                        <ul>
                                            <li><a href="about.html">About 01</a></li>
                                            <li><a href="about-2.html">About 02</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="contact.html">Contact</a>

                                        <ul>
                                            <li><a href="contact.html">Contact 01</a></li>
                                            <li><a href="contact-2.html">Contact 02</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="faq.html">FAQs</a></li>
                                    <li><a href="404.html">Error 404</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="blog.html">Blog</a>

                                <ul>
                                    <li><a href="blog.html">Classic</a></li>
                                    <li><a href="blog-listing.html">Listing</a></li>
                                    <li>
                                        <a href="#">Grid</a>
                                        <ul>
                                            <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                            <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                            <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                            <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Masonry</a>
                                        <ul>
                                            <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                            <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                            <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                            <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Mask</a>
                                        <ul>
                                            <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                            <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Single Post</a>
                                        <ul>
                                            <li><a href="single.html">Default with sidebar</a></li>
                                            <li><a href="single-fullwidth.html">Fullwidth no sidebar</a></li>
                                            <li><a href="single-fullwidth-sidebar.html">Fullwidth with sidebar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="elements-list.html">Elements</a>
                                <ul>
                                    <li><a href="elements-products.html">Products</a></li>
                                    <li><a href="elements-typography.html">Typography</a></li>
                                    <li><a href="elements-titles.html">Titles</a></li>
                                    <li><a href="elements-banners.html">Banners</a></li>
                                    <li><a href="elements-product-category.html">Product Category</a></li>
                                    <li><a href="elements-video-banners.html">Video Banners</a></li>
                                    <li><a href="elements-buttons.html">Buttons</a></li>
                                    <li><a href="elements-accordions.html">Accordions</a></li>
                                    <li><a href="elements-tabs.html">Tabs</a></li>
                                    <li><a href="elements-testimonials.html">Testimonials</a></li>
                                    <li><a href="elements-blog-posts.html">Blog Posts</a></li>
                                    <li><a href="elements-portfolio.html">Portfolio</a></li>
                                    <li><a href="elements-cta.html">Call to Action</a></li>
                                    <li><a href="elements-icon-boxes.html">Icon Boxes</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            <li><a class="mobile-cats-lead" href="#">Daily offers</a></li>
                            <li><a class="mobile-cats-lead" href="#">Gift Ideas</a></li>
                            <li><a href="#">Beds</a></li>
                            <li><a href="#">Lighting</a></li>
                            <li><a href="#">Sofas & Sleeper sofas</a></li>
                            <li><a href="#">Storage</a></li>
                            <li><a href="#">Armchairs & Chaises</a></li>
                            <li><a href="#">Decoration </a></li>
                            <li><a href="#">Kitchen Cabinets</a></li>
                            <li><a href="#">Coffee & Tables</a></li>
                            <li><a href="#">Outdoor Furniture </a></li>
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    <div class="container newsletter-popup-container mfp-hide" id="newsletter-popup-form">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="row no-gutters bg-white newsletter-popup-content">
                    <div class="col-xl-3-5col col-lg-7 banner-content-wrap">
                        <div class="banner-content text-center">
                            <!-- <img src="assets/images/popup/newsletter/logo.png" class="logo" alt="logo" width="60" height="15"> -->
                            <h2 class="banner-title">get <span>25<light>%</light></span> off</h2>
                            <p>Subscribe to the clickbuy eCommerce newsletter to receive timely updates from your favorite products.</p>
                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="Your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn" type="submit"><span>go</span></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">Do not show this popup again</label>
                            </div><!-- End .custom-checkbox -->
                        </div>
                    </div>
                    <div class="col-xl-2-5col col-lg-5 ">
                        <img src="assets/images/popup/newsletter/img-1.jpg" class="newsletter-img" alt="newsletter">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <?php include('./includes/footer.php') ?>
    <!-- script -->
    <?php include('./includes/script.php') ?>
</body>

</html>