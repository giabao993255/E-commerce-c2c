<?php
require_once('./includes/conn.php');
if (isset($_SESSION['taikhoan'])) {
  switch ($_SESSION['maquyen']) {
    case "NV":
      echo "<script>window.open('./staff/index.php','_self')</script>";
      break;
    case "KH":
      echo "<script>window.open('./index.php','_self')</script>";
      break;
    case "AM":
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
  <section class="login-form">
    <div class="container">
      <div class="login-form-center" align="center">
        <main class="main">
          <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
              </ol>
            </div>
          </nav>

          <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
            <div class="container">
              <div class="form-box">
                <div class="form-tab">
                  <ul class="nav nav-pills nav-fill" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                      <form action="#">
                        <div class="form-group">
                          <label for="singin-email-2">Username or email address *</label>
                          <input type="text" class="form-control" id="singin-email-2" name="singin-email" required>
                        </div><!-- End .form-group -->

                        <div class="form-group">
                          <label for="singin-password-2">Password *</label>
                          <input type="password" class="form-control" id="singin-password-2" name="singin-password" required>
                        </div><!-- End .form-group -->

                        <div class="form-footer">
                          <button type="submit" class="btn btn-outline-primary-2">
                            <span>LOG IN</span>
                            <i class="icon-long-arrow-right"></i>
                          </button>

                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                            <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                          </div><!-- End .custom-checkbox -->

                          <a href="#" class="forgot-link">Forgot Your Password?</a>
                        </div><!-- End .form-footer -->
                      </form>
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                      <form action="#">
                        <div class="form-group">
                          <label for="register-email-2">Your email address *</label>
                          <input type="email" class="form-control" id="register-email-2" name="register-email" required>
                        </div><!-- End .form-group -->

                        <div class="form-group">
                          <label for="register-password-2">Password *</label>
                          <input type="password" class="form-control" id="register-password-2" name="register-password" required>
                        </div><!-- End .form-group -->

                        <div class="form-footer">
                          <button type="submit" class="btn btn-outline-primary-2">
                            <span>SIGN UP</span>
                            <i class="icon-long-arrow-right"></i>
                          </button>

                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                            <label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
                          </div><!-- End .custom-checkbox -->
                        </div><!-- End .form-footer -->
                      </form>
                    </div><!-- .End .tab-pane -->
                  </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
              </div><!-- End .form-box -->
            </div><!-- End .container -->
          </div>
        </main>
      </div>

      <!-- footer -->
      <?php include('./includes/footer.php') ?>
      <!-- script -->
      <?php include('./includes/script.php') ?>
      <!-- jquery  -->
      <!-- MAIN JS -->
      <script src="./FE/js/validation.js"></script>
      <script src="./FE/js/main.js"></script>

      <?php
      require_once('./includes/conn.php');
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $TAIKHOAN = $_POST["taikhoan"];
        $MATKHAU = $_POST['matkhau'];
        $TENND = $_POST["hoten"];
        $EMAIL = $_POST['email'];
        $SDT = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $conn = Connect();
        $sql1 = "SELECT * FROM nguoidung WHERE TAIKHOAN='$TAIKHOAN'";
        $request = $conn->query($sql1);
        if (mysqli_num_rows($request) > 0) {
          echo "<script>alert('Tài khoản đã tồn tại!')</script>";
          echo "<script>window.open('login.php','_self')</script>";
        } else {
          $MATKHAU = md5($MATKHAU);
          $sql = "INSERT INTO `nguoidung`(`HOTEN`, `TAIKHOAN`, `MATKHAU`, `EMAIL`, `SDT`, `DIACHI`, `MAQUYEN`) VALUES ('$TENND','$TAIKHOAN','$MATKHAU','$EMAIL','$SDT','$diachi','KH')";
          if ($conn->query($sql) == true) {
            echo "<script>alert('Đăng ký thành công!')</script>";
            echo "<script>window.open('login.php','_self')</script>";
          } else {
            echo "error: " . $sql . "<br>" . $conn->error;
          }
        }
        $conn->close();
      }
      ?>
</body>

</html>