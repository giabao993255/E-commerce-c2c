<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$taikhoan = $_GET['taikhoan'];
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Giỏ hàng hiện tại của khách hàng: <?php echo $taikhoan ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_giohang = "SELECT DISTINCT * FROM GIOHANG, SANPHAM WHERE GIOHANG.MASANPHAM = SANPHAM.MASANPHAM AND TAIKHOAN = '$taikhoan'";
                $res_giohang = Check_db($sql_giohang);
                while ($row_giohang = mysqli_fetch_assoc($res_giohang)) {
                    $masp = $row_giohang['MASANPHAM'];
                    $tensp_giohang = $row_giohang['TENSANPHAM'];
                    $sql_tslsp = "SELECT SUM(SOLUONGSANPHAM) FROM GIOHANG WHERE MASANPHAM = '$masp' AND TAIKHOAN = '$taikhoan'";
                    $res_tslsp = Check_db($sql_tslsp);
                    $row_tslsp = mysqli_fetch_assoc($res_tslsp);
                    $soluongsanpham_giohang = $row_tslsp['SUM(SOLUONGSANPHAM)'];
                    $giasanpham_giohang = $row_giohang['GIASANPHAM'];
                    $sql_mgg = "SELECT DISTINCT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                    $res_mgg = Check_db($sql_mgg);
                    $row_mgg = mysqli_fetch_assoc($res_mgg);
                    if ($row_mgg != '') {
                        $mgg = $row_mgg['TILEGIAMGIA'];
                    } else {
                        $mgg = 0;
                    }
                    $gia = $row_giohang['GIASANPHAM'];
                    $saugiamgia = $gia - $gia * $mgg / 100;
                    $giahienthi = 0;
                    $tongtien = 0;
                    if ($mgg > 0) {
                        $giahienthi = $giasanpham_giohang - $giasanpham_giohang * $tilegiamgia / 100;
                    } else {
                        $giahienthi = $giasanpham_giohang;
                    }
                    $tongtien = $tongtien + $soluongsanpham_giohang * $giahienthi;
                ?>
                    <tr>
                        <td class="product-col">
                            <div class="product">
                                <?php echo $tensp_giohang ?>
                            </div>
                        </td>
                        <td class="price-col"><?php echo number_format($giahienthi, 0, '', ',') ?> (VND)</td>
                        <td class="quantity-col">
                            <div class="cart-product-quantity">
                                <input type="number" class="form-control" name='soluongsanpham' id='soluongsanpham' value="<?php echo $soluongsanpham_giohang ?>" min="1" max="10" step="1" data-decimals="0" required disabled>
                            </div>
                        </td>
                        <td class="price-col"><?php echo number_format($tongtien, 0, '', ',') ?> (VND)</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>