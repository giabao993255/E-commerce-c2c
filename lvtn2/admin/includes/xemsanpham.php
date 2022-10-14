<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>

<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách sản phẩm</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <table id="dataid" class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th class="text-center">Tên sản phẩm</th>
                <th class="text-center">Loại sản phẩm</th>
                <th class="text-center">Giá hiện tại</th>
                <th class="text-center">Số lượng trong kho</th>
                <th class="text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_product = "SELECT DISTINCT SANPHAM.MASANPHAM, SANPHAM.TENSANPHAM, LOAISANPHAM.TENLOAISANPHAM, SANPHAM.GIASANPHAM FROM SANPHAM, LOAISANPHAM, GIAMGIA WHERE SANPHAM.MALOAISANPHAM = LOAISANPHAM.MALOAISANPHAM AND HIENTHI = '1'";
            $res_sql_product = Check_db($sql_product);
            while ($row = mysqli_fetch_array($res_sql_product)) {
                $msp = $row['MASANPHAM'];
                $sql_mgg = "SELECT DISTINCT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$msp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                $res_mgg = Check_db($sql_mgg);
                $row_mgg = mysqli_fetch_assoc($res_mgg);
                if ($row_mgg != '') {
                    $mgg = $row_mgg['TILEGIAMGIA'];
                } else {
                    $mgg = 0;
                }
                $gia = $row['GIASANPHAM'];
                $saugiamgia = $gia - $gia * $mgg / 100;
            ?>
                <tr>
                    <td class="text-center"><?php echo $row['TENSANPHAM'] ?></td>
                    <td class="text-center"><?php echo $row['TENLOAISANPHAM'] ?></td>
                    <td class="text-center"><?php
                                            if ($saugiamgia > 0) {
                                                echo number_format($saugiamgia, 0, '', ',');
                                            } else {
                                                echo number_format($gia, 0, '', ',');
                                            }
                                            ?></td>
                    <td class="text-center">
                        <?php
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
                            if ($tongsoluongnhap - $tongsoluongban < 20) {
                                echo "<span class='btn btn-danger'> ", $tongsoluongnhap - $tongsoluongban, " </span>";
                            } else {
                                echo "<span class='btn btn-success'> ", $tongsoluongnhap - $tongsoluongban, " </span>";
                            }
                        } else {
                            if ($tongsoluongnhap < 20) {
                                echo "<span class='btn btn-danger'> ", $tongsoluongnhap, " </span>";
                            } else {
                                echo "<span class='btn btn-success'> ", $tongsoluongnhap, " </span>";
                            }
                        }
                        ?>
                    </td>
                    <td class="text-center">
                        <form method="POST">
                            <a class="btn btn-primary btn-submit btn-sm" href="index.php?action=chitietsanpham&masanpham=<?php echo $row['MASANPHAM'] ?>">Chi tiết</a>
                            <input class="btn btn-sm btn-danger" style="padding: 4px 15px 4px 15px;" type="submit" name="delete_product" id="delete_product" value="Xóa">
                            <input style="display: none" type="text" name="masanphamxoa" id="masanphamxoa" value="<?php echo $row['MASANPHAM'] ?>">
                        </form>
                    </td>
                </tr>
            <?php
            } // End while loop 
            ?>
        </tbody>
    </table>
</div>
<?php
if (isset($_POST['delete_product'])) {
    $masanphamxoa = $_POST['masanphamxoa'];
    $sql_del_product = "UPDATE `SANPHAM` SET `HIENTHI` = 0 WHERE `MASANPHAM` = '$masanphamxoa'";
    // echo $sql_del_product;
    if (Check_db($sql_del_product)) {
        echo "<script>alert('xóa sản phẩm thành công!')</script>";
        echo "<script>window.open('index.php?action=xemsanpham','_self')</script>";
    } else {
        echo "<script>alert('xóa sản phẩm thất bại!')</script>";
    }
}
?>
