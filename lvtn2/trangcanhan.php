<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$taikhoan = $_SESSION['taikhoan'];
$sql_taikhoan = "SELECT * FROM NGUOIDUNG WHERE TAIKHOAN = '$taikhoan'";
$res_taikhoan = Check_db($sql_taikhoan);
$row_taikhoan = mysqli_fetch_assoc($res_taikhoan);
$hoten = $row_taikhoan['HOTEN'];
$sdt = $row_taikhoan['SDT'];
$diachi = $row_taikhoan['DIACHI'];
$email = $row_taikhoan['EMAIL'];

if (isset($_POST['capnhat_tt'])) {
  $TENND = ($_POST["HOTEN"]);
  $EMAIL = $_POST['email'];
  $SDT = $_POST['sdt'];
  $DIACHI = $_POST['diaChi'];
  $conn = Connect();
  $sql1 = "UPDATE nguoidung SET TENND='$TENND',GIOITINH='$GIOITINH<?php echo EMAIL='$EMAIL',SDT='$SDT',DIACHI='$DIACHI' WHERE TAIKHOAN='$taikhoan'";
  if ($conn->query($sql1)) {
  } else {
    echo "error: " . $sql1 . "<br>" . $conn->error;
  }
  $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>

<body>
  <?php include('./includes/header.php') ?>
  <main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3"></nav>
    <div class="page-content">
      <div class="dashboard">
        <div class="container">
          <div class="row">
            <aside class="col-md-4 col-lg-2">
              <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Đặt hàng</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Đặt hàng</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Thông tin tài khoản</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./logout.php">Đăng xuất</a>
                </li>
              </ul>
            </aside>

            <div class="col-md-8 col-lg-10">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                  <?php
                  $sql_xuathang_taikhoan = "SELECT * FROM HOADONXUAT WHERE TAIKHOAN = '$taikhoan'";
                  $res_xuathang_taikhoan = Check_db($sql_xuathang_taikhoan);
                  if (mysqli_num_rows($res_xuathang_taikhoan) > 0) {
                  ?>
                    <table class="table table-cart table-mobile">
                      <thead>
                        <tr>
                          <th class="text-center">Sản phẩm</th>
                          <th class="text-center">Giá</th>
                          <th class="text-center">Số lượng</th>
                          <th class="text-center">Tổng tiền</th>
                          <th class="text-center">Trạng thái</th>
                          <th class="text-center">Ngày mua</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $taikhoan = $_SESSION['taikhoan'];
                        $sql_xuathang = "SELECT * FROM HOADONXUAT, SANPHAM WHERE HOADONXUAT.MASANPHAM = SANPHAM.MASANPHAM AND HOADONXUAT.TAIKHOAN = '$taikhoan' ORDER BY HOADONXUAT.NGAYXUAT DESC";
                        $res_xuathang = Check_db($sql_xuathang);
                        while ($row_xuathang = mysqli_fetch_assoc($res_xuathang)) {
                          $ngayxuat = $row_xuathang['NGAYXUAT'];
                          $masp = $row_xuathang['MASANPHAM'];
                          $tensp_xuathang = $row_xuathang['TENSANPHAM'];
                          $soluongsanpham_xuathang = $row_xuathang['SOLUONGSANPHAM'];
                          $giasanpham_xuathang = $row_xuathang['GIATIEN'];
                          $trangthai = $row_xuathang['TRANGTHAI'];
                          $tongtien = $soluongsanpham_xuathang * $giasanpham_xuathang;
                        ?>
                          <tr>
                            <td>
                              <h3 class="product-title">
                                <?php echo $tensp_xuathang ?>
                              </h3>
                            </td>
                            <td class="text-center"><?php echo number_format($giasanpham_xuathang, 0, "", ",") ?> (VND)</td>
                            <td class="text-center">
                              <div class="cart-product-quantity">
                                <input type="number" class="form-control" name="soluongsanpham" id="soluongsanpham" value="<?php echo $soluongsanpham_xuathang ?>" min="1" max="10" step="1" data-decimals="0" disabled>
                              </div>
                            </td>
                            <td class="text-center"><?php echo number_format($soluongsanpham_xuathang * $giasanpham_xuathang, 0, "", ",") ?> (VND)</td>
                            <td class="text-center">
                              <?php
                              if ($trangthai == 'soạn hàng') {
                                echo "...";
                              } else {
                                echo "V";
                              }
                              ?>
                            </td>
                            <td class="text-center">
                              <?php echo $ngayxuat ?>
                            </td>
                          </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  <?php
                  } else {
                    echo '<a href="./index.php" class="btn btn-outline-primary-2"><span>Xem sản phẩm của cửa hàng</span><i class="icon-long-arrow-right"></i></a>';
                  }
                  ?>

                </div>
                <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                  <form action="#">
                    <label>Họ tên *</label>
                    <input type="text" class="form-control" required value="<?php echo $hoten ?>">

                    <label>Email *</label>
                    <input type="email" class="form-control" required value="<?php echo $email ?>">

                    <label>Số điện thoại *</label>
                    <input type="number" class="form-control" required value="<?php echo $sdt ?>">

                    <label>Địa chỉ *</label>
                    <input type="text" class="form-control" required value="<?php echo $diachi ?>">

                    <label>Mật khẩu cũ</label>
                    <input type="password" class="form-control">

                    <label>Mật khẩu mới</label>
                    <input type="password" class="form-control">

                    <label>Xác nhận mật khẩu</label>
                    <input type="password" class="form-control mb-2">

                    <button type="submit" class="btn btn-outline-primary-2">
                      <span>Lưu</span>
                      <i class="icon-long-arrow-right"></i>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include('./includes/footer.php') ?>
  <?php include('./includes/script.php') ?>
</body>

</html>