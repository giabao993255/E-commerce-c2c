<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>
<div class="form_box">
    <h2>Đổi mật khẩu</h2>
    <form method="post" id="formDoiMatKhau" name="formDoiMatKhau">
        <table class="table" width="100%">
            <tr>
                <td valign="top"><b>Mật khẩu cũ:</b></td>
                <td>
                    <input type="password" name="matkhaucu" id="matkhaucu" required />
                    <span id="error_matkhaucu"></span>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Mật khẩu mới:</b></td>
                <td> <input type="password" name="matkhaumoi" id="matkhaumoi" required />
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Xác nhận mật khẩu mới:</b></td>
                <td>
                    <input type="password" name="xacnhanmatkhaumoi" id="xacnhanmatkhaumoi" required />
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="submit" class="btn btn-primary" name="doimatkhau" value="Đổi mật khẩu" />
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
if (isset(($_POST['doimatkhau']))) {
    $taikhoan = $_SESSION['taikhoan'];
    $matkhaucu = Get_value($_POST['matkhaucu']);
    $matkhaumoi = Get_value($_POST['matkhaumoi']);
    $xacnhanmatkhaumoi = Get_value($_POST['xacnhanmatkhaumoi']);
    if ($matkhaumoi == $xacnhanmatkhaumoi) {
        $matkhaucu_update = md5($matkhaucu);
        $matkhaumoi_update = md5($matkhaumoi);
        $sql = "SELECT * FROM NGUOIDUNG WHERE TAIKHOAN = '$taikhoan' AND MATKHAU = '$matkhaucu_update'";
        $res = Check_db($sql);
        if (mysqli_num_rows($res) > 0) {
            $sqlupdate =  "UPDATE NGUOIDUNG SET MATKHAU = '$matkhaumoi_update' WHERE TAIKHOAN = '$taikhoan'";
            $res = Check_db($sqlupdate);
            echo "<script>alert(\"Đổi mật khẩu thành công\")</script>";
        } else {
            echo "<script>alert(\"Sai mật khẩu cũ\")</script>";
        }
    } else {
        echo "<script>alert(\"Sai mật khẩu mới\")</script>";
    }
}
?>