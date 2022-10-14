<!DOCTYPE html>
<html lang="en">
<?php
include('./includes/head.php');
$tongtien = 0;
$max = 0;
?>

<body>
    <?php include('./includes/header.php') ?>
    <main class="main">
        <div class="page-content">
            <div class="cart">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $taikhoan = $_SESSION['taikhoan'];
                                    $sql_giohang = "SELECT DISTINCT * FROM GIOHANG, SANPHAM WHERE GIOHANG.MASANPHAM = SANPHAM.MASANPHAM AND TAIKHOAN = '$taikhoan' AND HIENTHI = 1";
                                    $res_giohang = Check_db($sql_giohang);
                                    while ($row_giohang = mysqli_fetch_assoc($res_giohang)) {
                                        $masp = $row_giohang['MASANPHAM'];
                                        $tensp_giohang = $row_giohang['TENSANPHAM'];
                                        $sql_tslsp = "SELECT SUM(SOLUONGSANPHAM) FROM GIOHANG WHERE MASANPHAM = '$masp' AND TAIKHOAN = '$taikhoan'";
                                        $res_tslsp = Check_db($sql_tslsp);
                                        $row_tslsp = mysqli_fetch_assoc($res_tslsp);
                                        $soluongsanpham_giohang = $row_tslsp['SUM(SOLUONGSANPHAM)'];
                                        $giasanpham_giohang = $row_giohang['GIASANPHAM'];
                                        $giahienthi = 0;
                                        $sql_mgg = "SELECT DISTINCT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                                        $res_mgg = Check_db($sql_mgg);
                                        $row_mgg = mysqli_fetch_assoc($res_mgg);
                                        if ($row_mgg != '') {
                                            $mgg = $row_mgg['TILEGIAMGIA'];
                                        } else {
                                            $mgg = 0;
                                        }
                                        $giahienthi = $giasanpham_giohang - $giasanpham_giohang * $mgg / 100;

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
                                            $max = $tongsoluongnhap - $tongsoluongban;
                                        } else {
                                            $max = $tongsoluongnhap;
                                        }
                                        if ($max > 0) {
                                            $tongtien = $tongtien + $giahienthi * $soluongsanpham_giohang;
                                    ?>
                                            <form action="./capnhatgiohang.php" method="GET">
                                                <tr>
                                                    <td class="product-col">
                                                        <div class="product">
                                                            <figure class="product-media">
                                                                <?php
                                                                $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                                                                $res_img = Check_db($sql_img);
                                                                $row = mysqli_fetch_assoc($res_img);
                                                                $duongdan = $row['DUONGDAN'];
                                                                ?>
                                                                <img src='./hinhanh/<?php echo $duongdan ?>' class='card-img-top' alt=''>
                                                            </figure>
                                                            <h3 class="product-title">
                                                                <?php echo $tensp_giohang ?>
                                                            </h3>
                                                        </div>
                                                    </td>
                                                    <td class="price-col"><?php echo number_format($giahienthi, 0, '', ',') ?> (VND)</td>
                                                    <td class="quantity-col">
                                                        <div class="cart-product-quantity">
                                                            <input type="number" class="form-control" name='soluongsanpham' id='soluongsanpham' value="<?php echo $soluongsanpham_giohang ?>" min="1" max="<?php echo $max ?>" step="1" data-decimals="0" required>
                                                        </div>
                                                    </td>
                                                    <td class="total-col"><?php echo number_format($soluongsanpham_giohang * $giahienthi, 0, '', ',') ?> (VND)</td>
                                                    <td class="remove-col mr-5">
                                                        <button class="btn-remove" type="button">
                                                            <a href="xoa.php?masp=<?php echo $masp ?>&taikhoan=<?php echo $taikhoan ?>">
                                                                X
                                                            </a>
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="masp" id="masp" value="<?php echo $masp ?>">
                                                        <button type="submit" class="btn-primary">
                                                            OK
                                                        </button>
                                                    </td>
                                                </tr>
                                            </form>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Tổng cộng</h3>
                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                            <td>Tổng cộng:</td>
                                            <td><?php echo number_format($tongtien, 0, '', ',') ?> VND</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="thanhtoan.php" class="btn btn-outline-primary-2 btn-order btn-block">Thanh toán</a>
                            </div>
                            <a href="index.php" class="btn btn-outline-dark-2 btn-block mb-3"><span>Mua thêm</span></a>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('./includes/footer.php') ?>
    <?php include('./includes/script.php') ?>


</body>