<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách mã giảm giá</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <!-- <th class="text-center">Mã giảm giá</th> -->
                    <th class="text-center">Tên giảm giá</th>
                    <th class="text-center">Tỉ lệ giảm giá</th>
                    <th class="text-center">Số sản phẩm đã áp dụng</th>
                    <th class="text-center">Thời gian áp dụng</th>
                    <th class="text-center">Thời gian kết thúc</th>
                    <!-- <th class="text-center">Thao tác</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_all_discount = "SELECT * FROM GIAMGIA";
                $res_all_discount = Check_db($sql_all_discount);
                while ($row = mysqli_fetch_array($res_all_discount)) {
                    $magiamgia = $row['MAGIAMGIA'];
                    $tengiamgia = $row['TENGIAMGIA'];
                    $tilegiamgia = $row['TILEGIAMGIA'];
                    $thoigianapdung = $row['THOIGIANAPDUNG'];
                    $thoigianketthuc = $row['THOIGIANKETTHUC'];
                ?>

                    <tr>
                        <td class="text-center"><?php echo $tengiamgia; ?></td>
                        <td class="text-center"><?php echo $tilegiamgia; ?>%</td>
                        <td class="text-center">
                            <?php
                            $sql_count = "SELECT COUNT(MASANPHAM) FROM SANPHAM WHERE MAGIAMGIA = '$magiamgia'";
                            $res_count = Check_db($sql_count);
                            $row2 = mysqli_fetch_array($res_count);
                            echo $row2['COUNT(MASANPHAM)'];
                            ?>
                        </td>
                        <td class="text-center"><?php echo $thoigianapdung; ?></td>
                        <td class="text-center"><?php echo $thoigianketthuc; ?></td>
                        <!-- <form method="post">
                            <td class="text-center">
                                <input class="btn btn-danger" type="submit" name="xoamagiamgia" id="xoamagiamgia" value="Xóa">
                                <input style="display: none" type="text" name="xoamagiamgia" id="xoamagiamgia" value="<?php echo $magiamgia; ?>">
                            </td>
                        </form> -->
                    </tr>

                <?php
                } // End while loop 
                ?>
            </tbody>
        </table>
    </form>
</div>

<?php
// function View_Discount_Of_Product($masp)
// {
//     $sql_discount = "SELECT * FROM giamgia WHERE MAGIAMGIA = (SELECT MAGIAMGIA FROM sanpham WHERE MASP = '$masp');";
//     $res_discount = Check_db($sql_discount);
//     if (mysqli_num_rows($res_discount) > 0) {
//         $row_discount = mysqli_fetch_assoc($res_discount);
//         return $row_discount['PHANTRAM'];
//     } else {
//         return 100;
//     }
// }

// if (isset($_POST['xoamagiamgia'])) {
//     $magiamgia = $_POST['xoamagiamgia'];
//     $sql_del_discount = "DELETE FROM GIAMGIA WHERE MAGIAMGIA = '$magiamgia'";
//     $res_del_discount = Check_db($sql_del_discount);
//     if ($res_del_discount) {
//         echo "<script>alert(\"Xóa mã giảm giá thành công\")</script>";
//         echo "<script>window.open('index.php?action=xemmagiamgia','_self')</script>";
//     } else {
//         echo "<script>alert('xóa giảm giá thất bại!')</script>";
//     }
// }

?>