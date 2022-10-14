<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (isset($_SESSION['MAQUYEN'])) {
    switch ($_SESSION['MAQUYEN']) {
        case "NV":
            echo "<script>window.open('./admin/index.php','_self')</script>";
            break;
        case "KH":
            echo "<script>window.open('./index.php','_self')</script>";
            break;
        case "QTV":
            echo "<script>window.open('./admin/index.php','_self')</script>";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include('./includes/head.php') ?>

<body>
    <!-- header -->
    <?php include('./includes/header.php') ?>
    <!-- banner -->
    <!-- login form -->
    <section class="login-form">
        <div class="container">
            <div class="login-form-center" align="center">
                <main class="main">
                    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                        <div class="container">
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Login</li> -->
                            </ol>
                        </div>
                    </nav>

                    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
                        <div class="container">
                            <div class="form-box">
                                <div class="form-tab">
                                    <ul class="nav nav-pills nav-fill" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Đăng nhập</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Đăng ký</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                                            <form action="" method="POST" onsubmit="return DangNhap()">
                                                <div class="form-group">
                                                    <label for="singin-email-2">Tài khoản *</label>
                                                    <input type="text" class="form-control" id="taikhoan" name="taikhoan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="singin-password-2">Mật khẩu *</label>
                                                    <input type="password" class="form-control" id="matkhau" name="matkhau" required>
                                                </div>
                                                <div class="form-footer">
                                                    <input type="submit" class="btn btn-outline-primary-2" style="padding: 5px 10px" value="Đăng nhập" name="submit_login">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                                            <form action="./signup.php" method="POST">
                                                <div class="form-group">
                                                    <label for="hoten">Họ tên *</label>
                                                    <input type="text" class="form-control" id="hoten" name="hoten" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="taikhoan">Tài khoản *</label>
                                                    <input type="text" class="form-control" id="taikhoan" name="taikhoan" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="matkhau">Mật khẩu *</label>
                                                    <input type="password" class="form-control" id="matkhau" name="matkhau" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email *</label>
                                                    <input type="email" class="form-control" id="email" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sdt">Số điện thoại *</label>
                                                    <input type="number" class="form-control" id="sdt" name="sdt" min="0100000000" max="0999999999" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="diachi">Địa chỉ *</label>
                                                    <input type="text" class="form-control" id="diachi" name="diachi" required>
                                                </div>
                                                <div class="form-footer">
                                                    <button type="submit" class="btn btn-outline-primary-2">
                                                        <span>Đăng ký</span>
                                                        <i class="icon-long-arrow-right"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php include('./includes/footer.php') ?>

            <?php include('./includes/script.php') ?>
</body>


</html>


<?php
if (isset($_POST['submit_login'])) {
    $taikhoan = Get_value($_POST["taikhoan"]);
    $matkhau = Get_value($_POST["matkhau"]);
    $matkhau = md5($matkhau);
    $sql = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan' AND matkhau = '$matkhau'";
    $res = Check_db($sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $_SESSION['taikhoan'] = $row['TAIKHOAN'];
        $_SESSION['maquyen'] = $row['MAQUYEN'];
        switch ($_SESSION['maquyen']) {
            case "NV":
                echo "<script>window.open('./admin/index.php','_self')</script>";
                break;
            case "KH":
                echo "<script>window.open('./index.php','_self')</script>";
                break;
            case "QTV":
                echo "<script>window.open('./admin/index.php','_self')</script>";
                break;
        }
    } else {
        echo "<script>alert('Tài khoản mật khẩu không trùng khớp')</script>";
    }
}
?>