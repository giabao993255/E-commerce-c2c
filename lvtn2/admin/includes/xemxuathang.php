<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');

?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách hóa đơn đặt hàng</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Ngày đặt hàng</th>
                    <th class="text-center">Tổng tiền đơn hàng</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_all_mdx = "SELECT DISTINCT MADONXUAT,TRANGTHAI FROM HOADONXUAT";
                $res_all_mdx = Check_db($sql_all_mdx);
                while ($row_all_mdx = mysqli_fetch_array($res_all_mdx)) {
                    $tongtiendonhang = 0;
                    $madonxuat = $row_all_mdx['MADONXUAT'];
                    $trangthai = $row_all_mdx['TRANGTHAI'];
                    $sql_one_mdx = "SELECT * FROM HOADONXUAT WHERE MADONXUAT = '$madonxuat'";
                    $res_one_mdx = Check_db($sql_one_mdx);
                    while ($row_one_mdx = mysqli_fetch_assoc($res_one_mdx)) {
                        $ngayxuat = $row_one_mdx['NGAYXUAT'];
                        $tongtiensanpham = $row_one_mdx['GIATIEN'] * $row_one_mdx['SOLUONGSANPHAM'];
                        $tongtiendonhang = $tongtiendonhang + $tongtiensanpham;
                    }
                ?>
                    <tr>
                        <td class="text-center"><?php echo $ngayxuat; ?></td>
                        <td class="text-center"><?php echo number_format($tongtiendonhang, 0, '', ',') ?></td>
                        <td class="text-center">

                            <?php
                            if ($trangthai == 'soạn hàng') {
                                echo '
                                <form method="POST">
                                    <input class="btn btn-danger btn-sm" type="submit" name="thaydoitrangthaidondathang" id="thaydoitrangthaidondathang" value="Soạn hàng">
                                    <input style="display: none" type="text" name="madonxuatcapnhat" id="madonxuatcapnhat" value="'. $madonxuat . '">
                                </form>
                            ';
                            } else {
                                echo '<span class="btn btn-success" style="cursor: none">Đã giao</span>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a href='index.php?action=chitietdonhang&madonhang=<?php echo $madonxuat ?>' class="btn btn-primary">Xem chi tiết</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
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