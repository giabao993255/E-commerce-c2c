<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách hóa đơn nhập hàng</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã đơn nhập hàng</th>
                    <th class="text-center">Tên nhà sản xuất</th>
                    <th class="text-center">Thời gian nhập hàng</th>
                    <th class="text-center">Tổng giá trị đơn hàng (VND)</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_all_mdn = "SELECT DISTINCT MADONNHAP FROM HOADONNHAP";
                $res_all_mdn = Check_db($sql_all_mdn);
                while ($row_all_mdn = mysqli_fetch_array($res_all_mdn)) {
                    $tongtiendonhang = 0;
                    $madonnhap = $row_all_mdn['MADONNHAP'];
                    $sql_one_mdn = "SELECT * FROM HOADONNHAP, NHASANXUAT WHERE HOADONNHAP.MANHASANXUAT = NHASANXUAT.MANHASANXUAT AND MADONNHAP = '$madonnhap'";
                    $res_one_mdn = Check_db($sql_one_mdn);
                    while ($row_one_mdn = mysqli_fetch_assoc($res_one_mdn)) {
                        $ngaynhap = $row_one_mdn['THOIGIANNHAP'];
                        $nsx = $row_one_mdn['TENNHASANXUAT'];
                        $tongtiensanpham = $row_one_mdn['GIASANPHAM'] * $row_one_mdn['SOLUONGNHAP'];
                        $tongtiendonhang = $tongtiendonhang + $tongtiensanpham;
                    }
                ?>
                    <tr>
                        <td class="text-center"><?php echo $madonnhap; ?></td>
                        <td class="text-center"><?php echo $nsx; ?></td>
                        <td class="text-center"><?php echo $ngaynhap; ?></td>
                        <td class="text-center"><?php echo number_format($tongtiendonhang, 0, '', ',')  ?></td>
                        <td class="text-center">
                            <a href='index.php?action=chitietnhaphang&manhaphang=<?php echo $madonnhap ?>' class="btn btn-primary">Xem chi tiết</a>
                        </td>
                    </tr>

                <?php
                } // End while loop 
                ?>
            </tbody>
        </table>
    </form>
</div>