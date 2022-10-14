<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (isset($_POST['insert_post'])) {
    Check_f5($_POST['insert_post']);
}
?>
<div class="form_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm tài khoản nhân viên</h1>
    </div>
    <form method="post">
        <table class="table table-border">
            <tr>
                <th>Họ tên nhân viên:</th>
                <td><input type="text" name="hoten" id="hoten" required /></td>
            </tr>
            <tr>
                <th>Tài khoản:</th>
                <td><input type="text" name="taikhoan" id="taikhoan" required /></td>
            </tr>

            <tr>
                <th>Mật khẩu: </th>
                <td><input type="password" name="matkhau" id="matkhau" required /></td>
            </tr>
            <tr>
                <th>Địa chỉ: </th>
                <td><input type="text" name="diachi" id="diachi" required /></td>
            </tr>

            <tr>
                <th>Số điện thoại:</th>
                <td>
                    <input type="number" name="sdt" id="sdt" required />
                    <span id="kiemtrasdt"></span>
                </td>
            </tr>

            <tr>
                <th>Email:</th>
                <td><input type="email" name="email" id="email" required /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" class="btn btn-primary" name="insert_post" value="Thêm tài khoản">
                </td>
            </tr>
        </table>
    </form>

</div>

<?php
if (isset($_POST['insert_post'])) {
    $taikhoan = Get_value($_POST['taikhoan']);
    $matkhau = Get_value(md5($_POST['matkhau']));
    $hoten = Get_value($_POST['hoten']);
    $sdt = $_POST['sdt'];
    $diachi = Get_value($_POST['diachi']);
    $email = Get_value($_POST['email']);
    $matkhau = md5($matkhau);
    $sql = "INSERT INTO `nguoidung` (`TAIKHOAN`, `MAQUYEN`, `MATKHAU`, `HOTEN`,  `SDT`, `DIACHI`, `EMAIL`) 
                VALUES ('$taikhoan', 'NV', '$matkhau', '$hoten', '$sdt', '$diachi', '$email');";
    $res = Check_db($sql);
    if ($res) {
        echo "<script>alert(\"Tạo tài khoản thành công\");</script>";
        echo "<script>window.open('./index.php?action=xemnhanvien','_self')</script>";
    } else {
        echo "<script>alert(\"Tạo tài khoản thất bại\");</script>";
    }
}
?>