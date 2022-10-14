<!DOCTYPE html>
<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
require_once('./includes/product.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['taikhoan'])) {
        $MASP = $_GET['masanpham'];
        include('./cart/tsx_SP_gio.php');
        themSP_gio($MASP);
    } else header('Location: login.php');
}
$masp = $_GET['masanpham'];

$sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
$res_img = Check_db($sql_img);
$row2 = mysqli_fetch_assoc($res_img);
$duongdan = $row2['DUONGDAN'];

$sql = "SELECT * FROM sanpham where MASANPHAM='$masp'";
$res = Check_db($sql);
$row = mysqli_fetch_assoc($res);
$gia = $row['GIASANPHAM'];
$chitiet = $row['CHITIETSANPHAM'];
$tensp = $row['TENSANPHAM'];
$sql_hdn = "SELECT SUM(SOLUONGNHAP) FROM HOADONNHAP WHERE HOADONNHAP.MASANPHAM = '$masp'";
$res_hdn = Check_db($sql_hdn);
$sql_hdx = "SELECT SUM(SOLUONGSANPHAM) FROM HOADONXUAT WHERE HOADONXUAT.MASANPHAM = '$masp'";
$res_hdx = Check_db($sql_hdx);
$row1 = mysqli_fetch_array($res_hdn);
$tongsoluongnhap = $row1['SUM(SOLUONGNHAP)'];
$max = 0;
if (mysqli_num_rows($res_hdx) > 0) {
    $tongsoluongban = 0;
    while ($row2 = mysqli_fetch_array($res_hdx)) {
        $tongsoluongban = $tongsoluongban + $row2['SUM(SOLUONGSANPHAM)'];
    }
    $max = $tongsoluongnhap - $tongsoluongban;
} else {
    $max = $tongsoluongnhap;
}
?>
<html lang="en">

<?php include('./includes/head.php') ?>

<body>
    <?php include('./includes/header.php') ?>
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="./index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="./">Products</a></li> -->
                </ol>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="">
                                    <figure class="product-main-image">
                                        <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                    </figure>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">
                                    <?php
                                    $sql_name = "SELECT TENSANPHAM FROM SANPHAM WHERE MASANPHAM = '$masp'";
                                    $res_name = Check_db($sql_name);
                                    $row3 = mysqli_fetch_assoc($res_name);
                                    echo $row3['TENSANPHAM'];
                                    ?>
                                </h1>
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
                                                    ?>%;">
                                        </div>
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
                                <div class="product-price">
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
                                <div class="details-filter-row details-row-size">
                                    <label>Color:</label>

                                    <div class="product-nav product-nav-thumbs">
                                        <a href="#" class="active">
                                            <?php
                                            $sql_timhinh = "SELECT * FROM `HINHANHSANPHAM` WHERE MASANPHAM = '$masp'";
                                            $res_timhinh = Check_db($sql_timhinh);
                                            $temp=0;
                                            while ($row_hinhanh = mysqli_fetch_assoc($res_timhinh)) {
                                                $duongdan = $row_hinhanh['DUONGDAN'];
                                                $temp = $temp + 1;
                                                if ($temp < 3) {
                                            ?>
                                                    <img src="./hinhanh/<?php echo $duongdan; ?>" alt="<?php echo $duongdan; ?>">';

                                            <?php
                                                } else {
                                                    break;
                                                }
                                            } // End while loop 
                                            ?>


                                        </a>
                                    </div><!-- End .product-nav -->
                                </div><!-- End .details-filter-row -->

                                <div class="details-filter-row details-row-size">
                                    <label for="qty">Số lượng:</label>
                                    <div class="product-details-quantity">
                                        <input type="number" id="qty" class="form-control" value="1" min="1" max="<?php echo $max ?>" step="1" data-decimals="0" required>
                                    </div>
                                </div>

                                <div class="product-details-action">
                                    <?php
                                    if (isset($_SESSION['taikhoan'])) {
                                    ?>
                                        <form action="" method="POST">
                                            <button type="submit" style="background: none; color: inherit; border: none; padding: 0; font: inherit; cursor: pointer; outline: inherit;">
                                                <a href="#" title="Add to cart" class="btn-product btn-cart">
                                                    <span>Thêm vào giỏ hàng</span>
                                                </a>
                                            </button>
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="./login.php" class="btn-product btn-cart" title="Add to cart">
                                            <span>Thêm vào giỏ hàng</span>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Chi tiết sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Đánh giá (
                                <?php
                                $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                $res_rating = Check_db($sql_rating);
                                $row = mysqli_fetch_assoc($res_rating);
                                echo $row['COUNT(MASANPHAM)'];
                                ?>
                                )
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                <h3>Thông tin sản phẩm</h3>
                                <p>
                                    <?php
                                    echo $chitiet;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                            <div class="reviews">
                                <h3>Đánh giá (
                                    <?php
                                    $sql_rating = "SELECT COUNT(MASANPHAM) FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                    $res_rating = Check_db($sql_rating);
                                    $row = mysqli_fetch_assoc($res_rating);
                                    echo $row['COUNT(MASANPHAM)'];
                                    ?>
                                    )
                                </h3>
                                <div class="review">
                                    <?php
                                    $sql_rating_by_account = "SELECT * FROM DANHGIA WHERE MASANPHAM = '$masp'";
                                    $res_rating_by_account = Check_db($sql_rating_by_account);
                                    while ($row_rating_by_account = mysqli_fetch_assoc($res_rating_by_account)) {
                                        $madanhgia = $row_rating_by_account['MADANHGIA'];
                                        $taikhoan_danhgia = $row_rating_by_account['TAIKHOAN'];
                                        $diemdanhgia_boitaikhoan = $row_rating_by_account['DIEMDANHGIA'];
                                        $thoigiandanhgia_boitaikhoan = $row_rating_by_account['THOIGIANDANHGIA'];
                                        $noidungdanhgia_boitaikhoan = $row_rating_by_account['NOIDUNG'];
                                    ?>
                                        <div class='row no-gutters'>
                                            <div class='col-auto'>
                                                <h4><?php echo $taikhoan_danhgia ?></h4>
                                                <div class='ratings-container'>
                                                    <div class='ratings'>
                                                        <div class='ratings-val' style='width: <?php echo $diemdanhgia_boitaikhoan * 20 ?>%'></div>
                                                    </div>
                                                </div>
                                                <span class='review-date'><?php echo $thoigiandanhgia_boitaikhoan ?></span>
                                            </div>
                                            <div class='col'>
                                                <div class='review-content'>
                                                    <p> <?php echo $noidungdanhgia_boitaikhoan ?> </p>
                                                </div>
                                                <a class="" data-toggle="collapse" href="#phanhoi_<?php echo $madanhgia ?>" role="button" aria-expanded="false" aria-controls="phanhoi_<?php echo $madanhgia ?>">
                                                    <?php
                                                    $sql_demphanhoi = "SELECT COUNT(MADANHGIA) FROM TRALOIDANHGIA WHERE MADANHGIA = '$madanhgia'";
                                                    $res_demphanhoi = Check_db($sql_demphanhoi);
                                                    if (mysqli_num_rows($res_demphanhoi) > 0) {
                                                        $row_demphanhoi = mysqli_fetch_assoc($res_demphanhoi);
                                                        echo $row_demphanhoi['COUNT(MADANHGIA)'];
                                                    } else {
                                                        echo '0';
                                                    }
                                                    ?>
                                                    phản hồi
                                                </a>
                                            </div>
                                        </div>
                                        <div class="collapse" id="phanhoi_<?php echo $madanhgia ?>">
                                            <?php
                                            $sql_traloidanhgia = "SELECT * FROM TRALOIDANHGIA WHERE MADANHGIA = '$madanhgia'";
                                            $res_traloidanhgia = Check_db($sql_traloidanhgia);
                                            if (mysqli_num_rows($res_traloidanhgia) > 0) {
                                                while ($row_traloidanhgia = mysqli_fetch_assoc($res_traloidanhgia)) {
                                                    $taikhoan_traloidanhgia = $row_traloidanhgia['TAIKHOAN'];
                                                    $noidung_traloidanhgia = $row_traloidanhgia['NOIDUNGTRALOI'];
                                                    $thoigian_traloidanhgia = $row_traloidanhgia['THOIGIANTRALOI'];
                                            ?>
                                                    <div class='row'>
                                                        <div class="col-1"> </div>
                                                        <div class='col-auto'>
                                                            <h3><?php echo $taikhoan_traloidanhgia ?></h3>
                                                            <span class='review-date'><?php echo $thoigian_traloidanhgia ?></span>
                                                        </div>
                                                        <div class='col'>
                                                            <div class='review-content'>
                                                                <p> <?php echo $noidung_traloidanhgia ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            if (isset($_SESSION['taikhoan'])) {
                                            ?>
                                                <div class='row'>
                                                    <div class="col-1"> </div>
                                                    <div class='col-11'>
                                                        <form action="./includes/traloidanhgia.php" method="post">
                                                            <input type="hidden" name="masanpham" value="<?php echo $masp ?>">
                                                            <input type="hidden" name="madanhgia" value="<?php echo $madanhgia ?>">
                                                            <input type="hidden" name="taikhoan" value="<?php echo $taikhoan ?>">
                                                            <textarea class="col-12" name="noidung" id="" cols="160" rows="5" placeholder="Để lại bình luận sản phẩm" style="resize: none;" required></textarea>
                                                            <button class="col-12 btn btn-primary" type="submit">Gửi</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if (isset($_SESSION['taikhoan'])) {
                            ?>
                                <a class="btn btn-primary col-12" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Viết đánh giá
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <form action="./includes/danhgia.php" method="post">
                                        <span class="star-rating star-5">
                                            <input type="radio" name="rating" value="1"><i></i>
                                            <input type="radio" name="rating" value="2"><i></i>
                                            <input type="radio" name="rating" value="3"><i></i>
                                            <input type="radio" name="rating" value="4"><i></i>
                                            <input type="radio" name="rating" value="5" checked><i></i>
                                        </span>
                                        <style>
                                            .star-rating {
                                                font-size: 0;
                                                white-space: nowrap;
                                                display: inline-block;
                                                /* width: 250px; remove this */
                                                height: 50px;
                                                overflow: hidden;
                                                position: relative;
                                                background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
                                                background-size: contain;
                                            }

                                            .star-rating i {
                                                opacity: 0;
                                                position: absolute;
                                                left: 0;
                                                top: 0;
                                                height: 100%;
                                                z-index: 1;
                                                background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
                                                background-size: contain;
                                            }

                                            .star-rating input {
                                                -moz-appearance: none;
                                                -webkit-appearance: none;
                                                opacity: 0;
                                                display: inline-block;
                                                height: 100%;
                                                margin: 0;
                                                padding: 0;
                                                z-index: 2;
                                                position: relative;
                                            }

                                            .star-rating input:hover+i,
                                            .star-rating input:checked+i {
                                                opacity: 1;
                                            }

                                            .star-rating i~i {
                                                width: 40%;
                                            }

                                            .star-rating i~i~i {
                                                width: 60%;
                                            }

                                            .star-rating i~i~i~i {
                                                width: 80%;
                                            }

                                            .star-rating i~i~i~i~i {
                                                width: 100%;
                                            }

                                            ::after,
                                            ::before {
                                                height: 100%;
                                                padding: 0;
                                                margin: 0;
                                                box-sizing: border-box;
                                                text-align: center;
                                                vertical-align: middle;
                                            }

                                            .star-rating.star-5 {
                                                width: 250px;
                                            }

                                            .star-rating.star-5 input,
                                            .star-rating.star-5 i {
                                                width: 20%;
                                            }

                                            .star-rating.star-5 i~i {
                                                width: 40%;
                                            }

                                            .star-rating.star-5 i~i~i {
                                                width: 60%;
                                            }

                                            .star-rating.star-5 i~i~i~i {
                                                width: 80%;
                                            }

                                            .star-rating.star-5 i~i~i~i~i {
                                                width: 100%;
                                            }
                                        </style>
                                        <input type="hidden" name="masp" value="<?php echo $masp ?>">
                                        <input type="hidden" name="taikhoan" value="<?php echo $taikhoan ?>">
                                        <textarea class="col-12" name="noidung" id="" cols="160" rows="5" placeholder="Để lại bình luận sản phẩm" style="resize: none;" required></textarea>
                                        <button class="col-12 btn btn-primary" type="submit">Gửi</button>
                                    </form>
                                </div>
                            <?php
                            } else {
                            ?>
                                <a href="./login.php" class="btn-product btn-cart" title="viet danh gia">
                                    <span>Viết đánh giá</span>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <?php include('./includes/footer.php') ?>
    <?php include('./includes/script.php') ?>
</body>