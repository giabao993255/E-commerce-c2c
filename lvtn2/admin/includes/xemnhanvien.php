<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>


<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách nhân viên</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Tài khoản</th>
                    <th class="text-center">Họ và tên</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Địa chỉ</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_all_staff = "SELECT * FROM NGUOIDUNG WHERE MAQUYEN = 'NV'";
                $res_all_staff = Check_db($sql_all_staff);
                while ($row = mysqli_fetch_array($res_all_staff)) {
                ?>

                    <tr>
                        <td class="text-center"><?php echo $row['TAIKHOAN'] ?></td>
                        <td class="text-center"><?php echo $row['HOTEN'] ?></td>
                        <td class="text-center"><?php echo $row['SDT'] ?></td>
                        <td class="text-center"><?php echo $row['DIACHI'] ?></td>
                        <td class="text-center"><?php echo $row['EMAIL'] ?></td>
                        <td class="text-center">
                            <form method="post">
                                <input class="btn btn-danger btn-sm" style="padding: 4px 15px 4px 15px;" type="submit" name="delete_staff" id="delete_staff" value="Xóa">
                                <input style="display: none" type="text" name="taikhoan" id="taikhoan" value="<?php echo $row['TAIKHOAN']; ?>">
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
function Check_Staff($taikhoan)
{
    if (isset($_POST['submit'])) {
        $sql = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan';";
        $res = Check_db($sql);
        if (mysqli_num_rows($res) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

if (isset($_POST['delete_staff'])) {
    $taikhoan = $_POST['taikhoan'];
    $sql_del_staff = "DELETE FROM NGUOIDUNG WHERE taikhoan = '$taikhoan';";
    echo $sql_del_staff;
    $res_del_staff = Check_db($sql_del_staff);
    if ($res_del_staff) {
        echo "<script>alert('Tài khoản được xóa thành công!')</script>";
        echo "<script>window.open('index.php?action=xemnhanvien','_self')</script>";
    } else {
        echo "<script>alert('xóa tài khoản không thành công!')</script>";
    }
}
?>