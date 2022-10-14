<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$taikhoan = $_GET['taikhoan'];
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lịch sử mua hàng của khách hàng: <?php echo $taikhoan ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Ngày mua</th>
                    <th class="text-center">Sản phẩm</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_xuathang = "SELECT * FROM HOADONXUAT, SANPHAM WHERE HOADONXUAT.MASANPHAM = SANPHAM.MASANPHAM AND HOADONXUAT.TAIKHOAN = '$taikhoan'";
                $res_xuathang = Check_db($sql_xuathang);
                while ($row_xuathang = mysqli_fetch_assoc($res_xuathang)) {
                    $ngayxuat = $row_xuathang['NGAYXUAT'];
                    $masp = $row_xuathang['MASANPHAM'];
                    $tensp_xuathang = $row_xuathang['TENSANPHAM'];
                    $soluongsanpham_xuathang = $row_xuathang['SOLUONGSANPHAM'];
                    $giasanpham_xuathang = $row_xuathang['GIATIEN'];
                    $tongtien = $soluongsanpham_xuathang * $giasanpham_xuathang;
                ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $ngayxuat ?>
                        </td>
                        <td class="text-center">
                            <div class="product">
                                <?php echo $tensp_xuathang ?>
                            </div>
                        </td>
                        <td class="text-center"><?php echo number_format($giasanpham_xuathang, 0, "", ",") ?> (VND)</td>
                        <td class="text-center">
                            <div class="cart-product-quantity">
                                <input type="number" class="form-control" name="soluongsanpham" id="soluongsanpham" value="<?php echo  $soluongsanpham_xuathang ?>" min="1" max="10" step="1" data-decimals="0" disabled>
                            </div>
                        </td>
                        <td class="text-center"><?php echo number_format($soluongsanpham_xuathang * $giasanpham_xuathang, 0, "", ",") ?> (VND)</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>