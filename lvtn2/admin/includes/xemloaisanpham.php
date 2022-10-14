<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>
<div class="view_category_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách loại sản phẩm</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã loại sản phẩm:</th>
                    <th class="text-center">Tên loại sản phẩm:</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_all_cat = "SELECT * FROM  LOAISANPHAM";
                $res_all_cat = Check_db($sql_all_cat);
                while ($row = mysqli_fetch_assoc($res_all_cat)) {
                    $maloaisp = $row['MALOAISANPHAM'];
                    $tenloaisp = $row['TENLOAISANPHAM'];
                ?>

                    <tr>
                        <td class="text-center"><?php echo $maloaisp; ?></td>
                        <td class="text-center"><?php echo $tenloaisp; ?></td>
                        <form method="post">
                            <td class="text-center">
                                <!-- <a class="btn btn-primary" href="#">Cập nhật</a> -->
                                <input class="btn btn-danger" type="submit" name="delete_category" id="delete_category" value="Xóa">
                                <input style="display: none" type="text" name="maloaisp" id="maloaisp" value="<?php echo $maloaisp; ?>">
                            </td>
                        </form>
                    </tr>

                <?php
                } // End while loop 
                ?>
            </tbody>
        </table>

    </form>

</div>
<?php
// ERROR
if (isset($_POST['delete_category'])) {
    $maloaisp = $_POST['maloaisp'];
    $sql_check = "SELECT SANPHAM.MALOAISANPHAM FROM SANPHAM, LOAISANPHAM WHERE SANPHAM.MALOAISANPHAM = LOAISANPHAM.MALOAISANPHAM AND SANPHAM.MALOAISANPHAM = '$maloaisp'";
    $res_check = Check_db($sql_check);
    if (mysqli_num_rows($res_check) > 0) {
        echo "<script>alert('xóa loại sản phẩm thất bại!')</script>";
    } else {
        $sql_del_category = "DELETE FROM LOAISANPHAM WHERE MALOAISANPHAM = '$maloaisp'";
        $res_del_category = Check_db($sql_del_category);
        if ($res_del_category) {
            echo "<script>alert('xóa loại sản phẩm thành công!')</script>";
            echo "<script>window.open('index.php?action=xemloaisanpham','_self')</script>";
        } else {
            echo "<script>alert('xóa loại sản phẩm thất bại!')</script>";
        }
    }
}
?>