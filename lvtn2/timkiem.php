<?php
$timsp = $_GET['tim'];
?>
<html lang="en">

<?php include('./includes/head.php') ?>

<body>
    <?php include('./includes/header.php') ?>
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="products mb-3">
                            <div class="row justify-content-center">
                                <?php
                                $sql_tim = "SELECT *
                                FROM SANPHAM
                                LEFT JOIN LOAISANPHAM
                                ON SANPHAM.MALOAISANPHAM = LOAISANPHAM.MALOAISANPHAM 
                                WHERE TENSANPHAM LIKE '%$timsp%' OR LOAISANPHAM.MALOAISANPHAM = '$timsp' AND HIENTHI = 1";
                                $res_tim = Check_db($sql_tim);
                                if (mysqli_num_rows($res_tim) > 0) {
                                    while ($row_tim = mysqli_fetch_array($res_tim)) {
                                        $masp = $row_tim['MASANPHAM'];
                                        $tensp = $row_tim['TENSANPHAM'];
                                        $tenlsp = $row_tim['TENLOAISANPHAM'];
                                        $giasp = $row_tim['GIASANPHAM'];
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
                                                <div class="col-md-3 col-lg-3">
                                                    <div class="product product-7 text-center">
                                                        <figure class="product-media">
                                                            <a href="./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>">
                                                                <?php
                                                                $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                                                $res_img = Check_db($sql_img);
                                                                $row = mysqli_fetch_assoc($res_img);
                                                                $duongdan = $row['DUONGDAN'];
                                                                ?>
                                                                <img src="./hinhanh/<?php echo $duongdan ?>" class="" alt="">
                                                            </a>
                                                        </figure>
                                                        <div class="product-body">
                                                            <div class="product-cat">
                                                                <a href="./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>"></a>
                                                            </div>
                                                            <h3 class="product-title"><a href="./xemthongtinsanpham.php?masanpham=<?php echo $masp ?>"><?php echo $tensp ?></a></h3>
                                                            <div class="product-price">
                                                                <?php
                                                                $sql_timmgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN thoigianapdung AND thoigianketthuc";
                                                                $res_timmgg = Check_db($sql_timmgg);
                                                                if (mysqli_num_rows($res_timmgg) > 0) {
                                                                    $row_timmgg = mysqli_fetch_assoc($res_timmgg);
                                                                    $giasaugiam = $giasp - $giasp * $row_timmgg['TILEGIAMGIA'] / 100;
                                                                    echo " <div class='product-price '>" . number_format($giasaugiam, 0, '', ',') . " VND </div>";
                                                                } else {
                                                                    echo " <div class='product-price '>" . number_format($giasp, 0, '', ',') . " VND </div>";
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
                                                    </div>
                                                </div>

                                    <?php
                                            }
                                        }
                                    }
                                } else {
                                    ?>
                                    <main class="main">
                                        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                                            <div class="container">
                                                <ol class="breadcrumb">
                                                </ol>
                                            </div>
                                        </nav>

                                        <div class="error-content text-center" style="background-image: url(assets/images/backgrounds/error-bg.jpg)">
                                            <div class="container">
                                                <h1 class="error-title">Không tìm thấy sản phẩm.</h1>
                                                <p>Sản phẩm bạn tìm kiếm hiện cửa hàng đã hết. Xin vui lòng quay lại sau!</p>
                                                <a href="./index.php" class="btn btn-outline-primary-2 btn-minwidth-lg">
                                                    <span>TRỞ VỀ TRANG CHỦ</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </main>
                            </div>
                        </div>
                    <?php
                                }
                    ?>
                    </div>
    </main>
    <?php include('./includes/footer.php') ?>
    <?php include('./includes/script.php') ?>
</body>