<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$manhaphang = $_GET['manhaphang'];
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết hóa đơn nhập hàng: <?php echo $manhaphang ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="table table-border" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã sản phẩm nhập</th>
                    <th class="text-center">Số lượng nhập</th>
                    <th class="text-center">Giá nhập</th>
                    <th class="text-center">Thành tiền</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT * FROM HOADONNHAP WHERE HOADONNHAP.MADONNHAP = '$manhaphang'";
            $res = Check_db($sql);
            $tongtiendonhang = 0;
            while ($row = mysqli_fetch_array($res)) {
                $tongtiensanpham = 0;
                $TENSANPHAM = $row['MASANPHAM'];
                $SOLUONGNHAP = $row['SOLUONGNHAP'];
                $GIASANPHAM = $row['GIASANPHAM'];
                $tongtiensanpham = $GIASANPHAM * $SOLUONGNHAP;
                $tongtiendonhang = $tongtiendonhang + $tongtiensanpham;
            ?>
                <tbody>
                    <tr>
                        <td class="text-center"><?php echo $TENSANPHAM; ?></td>
                        <td class="text-center"><?php echo $SOLUONGNHAP; ?></td>
                        <td class="text-center"><?php echo number_format($GIASANPHAM, 0, '', ',') ?></td>
                        <td class="text-center"><?php echo number_format($tongtiensanpham, 0, '', ',')  ?></td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center"><b>Tổng:</b></td>
                    <td class="text-center"><?php echo number_format($tongtiendonhang, 0, '', ',')  ?></td>
                </tr>
            </tfoot>
        </table>
    </form>
</div>