<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách nhà sản xuất</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã nhà sản xuất</th>
                    <th class="text-center">Tên nhà sản xuất</th>
                    <th class="text-center">Địa chỉ nhà sản xuất</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_all_nsx = "SELECT * FROM NHASANXUAT";
                $res_all_nsx = Check_db($sql_all_nsx);
                while ($row = mysqli_fetch_array($res_all_nsx)) {
                    $mansx = $row['MANHASANXUAT'];
                    $tennsx = $row['TENNHASANXUAT'];
                    $diachinhasanxuat = $row['DIACHINSX'];
                ?>

                    <tr>
                        <td class="text-center"><?php echo $mansx; ?></td>
                        <td class="text-center"><?php echo $tennsx; ?></td>
                        <td class="text-center"><?php echo $diachinhasanxuat ?></td>
                        <td class="text-center">
                            <form method="post">
                                <input class="btn btn-danger text-center" style="padding: 4px 15px 4px 15px;" type="submit" name="delete_producer" id="delete_producer" value="Xóa">
                                <input style="display: none" type="text" name="mansx" id="mansx" value="<?php echo $mansx; ?>">
                            </form>
                        </td>
                    </tr>

                <?php
                } // End while loop 
                ?>
            </tbody>
        </table>
    </form>
</div>
<?php
if (isset($_POST['delete_producer'])) {
    $mansx = $_POST['mansx'];
    $sql_check = "SELECT SANPHAM.MANHASANXUAT FROM SANPHAM, NHASANXUAT WHERE SANPHAM.MANHASANXUAT = NHASANXUAT.MANHASANXUAT AND SANPHAM.MANHASANXUAT = '$mansx'";
    $res_check = Check_db($sql_check);
    if (mysqli_num_rows($res_check) > 0) {
        echo "<script>alert('xóa nhà sản xuất thất bại!')</script>";
    } else {
        $sql_del_producer = "DELETE FROM NHASANXUAT WHERE MANHASANXUAT = '$mansx'";
        $res_del_producer = Check_db($sql_del_producer);
        if ($res_del_producer) {
            echo "<script>alert('xóa nhà sản xuất thành công!')</script>";
            echo "<script>window.open('index.php?action=xemnhasanxuat','_self')</script>";
        } else {
            echo "<script>alert('xóa nhà sản xuất thất bại!')</script>";
        }
    }
}
?>