<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$madonhang = $_GET['madonhang'];
$sql_dxh = "SELECT * FROM HOADONXUAT, SANPHAM WHERE HOADONXUAT.MASANPHAM = SANPHAM.MASANPHAM AND HOADONXUAT.MADONXUAT = '$madonhang'";
$tongtiendonhang = 0;
$res_dxh = Check_db($sql_dxh);
$rowtt = mysqli_fetch_assoc($res_dxh);
$trangthai = $rowtt['TRANGTHAI'];
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết hóa đơn đặt hàng: <?php echo $madonhang ?></h1>
        <?php
        if ($trangthai == 'soạn hàng') {
            echo '
                                <form method="POST">
                                    <input class="btn btn-danger btn-sm" type="submit" name="thaydoitrangthaidondathang" id="thaydoitrangthaidondathang" value="Soạn hàng">
                                    <input style="display: none" type="text" name="madonxuatcapnhat" id="madonxuatcapnhat" value="' . $madonhang . '">
                                </form>
                            ';
        } else {
            echo '<span class="btn btn-success" style="cursor: none">Đã giao</span>';
        }
        ?>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="table table-border" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Tên sản phẩm đặt</th>
                    <th class="text-center">Số lượng sản phẩm đặt</th>
                    <th class="text-center">Giá sản phẩm khi đặt</th>
                    <th class="text-center">Tổng số tiền</th>
                </tr>
            </thead>
            <?php
            $sql_dxh = "SELECT * FROM HOADONXUAT, SANPHAM WHERE HOADONXUAT.MASANPHAM = SANPHAM.MASANPHAM AND HOADONXUAT.MADONXUAT = '$madonhang'";
            $tongtiendonhang = 0;
            $res_dxh = Check_db($sql_dxh);
            while ($row_dxh = mysqli_fetch_assoc($res_dxh)) {
                $tensp = $row_dxh['TENSANPHAM'];
                $slsp = $row_dxh['SOLUONGSANPHAM'];
                $giasp = $row_dxh['GIATIEN'];
                $tongtien = $row_dxh['GIATIEN'] * $row_dxh['SOLUONGSANPHAM'];
                $tongtiendonhang = $tongtiendonhang + $tongtien;
            ?>
                <tbody>
                    <tr>
                        <td class="text-center"><?php echo $tensp; ?></td>
                        <td class="text-center"><?php echo $slsp; ?></td>
                        <td class="text-center"><?php echo number_format($giasp, 0, '', ',') ?></td>
                        <td class="text-center"><?php echo number_format($tongtien, 0, '', ',') ?></td>
                    </tr>
                </tbody>
            <?php
            } // End while loop 
            ?>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center"><b>Tổng:</b></td>
                    <td class="text-center"><?php echo number_format($tongtiendonhang, 0, '', ',') ?></td>
                </tr>
                <?php
                $sql_taikhoan = "SELECT * FROM HOADONXUAT, NGUOIDUNG WHERE HOADONXUAT.TAIKHOAN = NGUOIDUNG.TAIKHOAN AND HOADONXUAT.MADONXUAT = '$madonhang'";
                $res_taikhoan = Check_db($sql_taikhoan);
                $row_taikhoan = mysqli_fetch_assoc($res_taikhoan);
                ?>
                <tr>
                    <td class="text-left">Họ và tên:</td>
                    <td class="text-left" colspan="3"><?php echo $ten = $row_taikhoan['HOTEN']; ?></td>
                </tr>
                <tr>
                    <td class="text-left">Địa chỉ</td>
                    <td class="text-left" colspan="3"><?php echo $ten = $row_taikhoan['DIACHI']; ?></td>
                </tr>
                <tr>
                    <td class="text-left">Số điện thoại</td>
                    <td class="text-left" colspan="3"><?php echo $ten = $row_taikhoan['SDT']; ?></td>
                </tr>
                <tr>
                    <td class="text-left">Email:</td>
                    <td class="text-left" colspan="3"><?php echo $ten = $row_taikhoan['EMAIL']; ?></td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>
<?php
if (isset($_POST['thaydoitrangthaidondathang'])) {
    $madonxuatcapnhat = $_POST['madonxuatcapnhat'];
    $sql_update = "UPDATE `hoadonxuat` SET `TRANGTHAI`='đã giao' WHERE MADONXUAT = '$madonxuatcapnhat'";
    $res_update = Check_db($sql_update);
    if ($res_update) {
        echo "<script>window.open('index.php?action=xemxuathang','_self')</script>";
    } else {
        echo "<script>alert('lỗi!')</script>";
    }
    echo $sql_update;
}
?>