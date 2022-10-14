<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
require_once('./includes/product.php');
require_once('./includes/config.php');
require_once('./includes/order.php');
$taikhoan = $_SESSION['taikhoan'];
$thongtin = Get_Info_Account($taikhoan);
$tennd = $thongtin['tennd'];
$sdt = $thongtin['sdt'];
$email = $thongtin['email'];
$diachi = $thongtin['diachi'];
?>

<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>

<body>
  <!-- header -->
  <?php include('./includes/header.php') ?>
  <!-- payment page-->
  <section id="payment" class="privacy">
    <div class="container">
      <!-- tittle heading -->
      <h2 id="payment-title" class="text-center">
        <span>P</span>ayment
      </h2>
      <section class="cartItem">
        <div class="container">
            <table id="tblItem" class="table">
              <thead id="tblHead">
                <tr>
                  <th>Hình Ảnh Sản Phẩm</th>
                  <th>Tên Sản Phẩm</th>
                  <th>Đơn Giá</th>
                  <th>Số lượng</th>
                  <th>Số Tiền</th>
                </tr>
              </thead>
              <tbody id="tblBody">
                <?php
                $sql_cart = "SELECT * FROM SANPHAMGIOHANG, SANPHAM WHERE SANPHAMGIOHANG.MASP = SANPHAM.MASP and taikhoan = '$taikhoan'";
                $res_cart = Check_db($sql_cart);
                $temp = 0;
                $tongtien = 0;
                if (mysqli_num_rows($res_cart)) {
                  while ($row = mysqli_fetch_assoc($res_cart)) {
                    $masp = $row['MASP'];
                    $tensp = $row['TENSP'];
                    $gia = $row['GIA'];
                    $phantram = View_Discount_Of_Product($masp);
                    if ($gia - $gia * $phantram / 100 < $gia) {
                      $gia = $gia - $gia * $phantram / 100;
                    }
                    $soluonggio = $row['SOLUONGGIO'];
                    $temp++;
                ?>
                    <tr>
                      <td>
                        <a href="#" class="cartItem__product">
                          <img src="./FE/image/laptop.jpg" alt="">
                        </a>
                      </td>
                      <td>
                        <div class="cartItem__product--intro">
                          <h4><?php echo $tensp ?></h4>
                        </div>
                      </td>
                      <td><?php echo $gia ?></td>
                      <td>
                        <span><?php echo $soluonggio ?></span>
                      </td>
                      <td>
                        <?php $tongtien = $tongtien + $gia * $soluonggio;
                        echo $gia * $soluonggio;
                        ?>
                      </td>
                    </tr>
                <?php
                  }
                  if (isset($_POST[$masp])) {
                    $soluonggio = $_POST['soluonggio'];
                    $sql = "UPDATE sanphamgiohang SET SOLUONGGIO='$soluonggio' WHERE TAIKHOAN='$taikhoan' AND MASP='$masp'";
                    if ($res = Check_db($sql)) {
                      echo "<script>alert('Cập nhật thành công!') </script>";
                      echo "<script>window.open('cart.php','_self')</script>";
                    } else {
                      echo "<script>alert('sua gio hang that bai')</script>";
                    }
                  }
                } //end loop
                ?>
              </tbody>
              <tfoot id="tblFooter">
                <tr>
                  <td colspan="3">
                  </td>
                  <th style="text-align: center;">
                    <span>Tổng tiền:</span>
                  </th>
                  <!-- tong tien don hang-->
                  <td id="tongtien" name="tongtien">$<?php echo $tongtien; ?></td>
                </tr>
              <form action="./includes/charge.php" method="POST">
                <tr>
                  <td colspan="2" style="padding: 0;">
                    <div id="thongTinTaiKhoan">
                      <table>
                        <tr>
                          <th>
                            <label for="firstName">Họ tên:</label>
                          </th>
                          <td>
                            <input type="text" name="tennd" id="userFistName" value="<?php echo $tennd ?>" disabled />
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <label for="email">Email:</label>
                          </th>
                          <td>
                            <input type="email" name="email" id="userEmail" value="<?php echo $email ?>" required/>
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <label for="sdt">Số điện thoại:</label>
                          </th>
                          <td>
                            <input type="tel" name="sdt" id="" value="<?php echo $sdt ?>" disabled />
                          </td>
                        </tr>
                        <tr>
                          <th>
                            <label for="diachi">Địa chỉ:</label>
                          </th>
                          <td>
                            <input type="text" name="diachi" id="diachi" value="<?php echo $diachi ?>" required />
                          </td>
                          <td>
                            <input style="display: none" type="text" name="tongtien" id="tongtien" value="<?php echo $tongtien; ?>">
                            <input style="display: none" type="text" name="taikhoan" id="taikhoan" value="<?php echo $taikhoan; ?>">
                          </td>
                        </tr>
                      </table>
                    </div>
                  </td>
                  <th style="text-align: center;">
                    Hình thức thanh toán:
                  </th>
                  <td style="text-align: center;">
                      <script id="scriptStripe" src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $stripe['publishable_key']; ?>" data-description="Thanh toán" data-locale="auto"></script>
                  </td>
                </form>
                  <td style="text-align: center;">
                      <form action="./COD.php" method="POST">
                        <input style="display: none" type="text" name="tongtien_offline" id="tongtien_offline" value="<?php echo $tongtien; ?>">
                        <input style="display: none" type="text" name="diachi_offline" id="diachi_offline" value="<?php echo $diachi; ?>"/>
                        <input type="submit" name="COD" onclick="Get_Address()" style="padding: 5px 10px; background-image: linear-gradient(#28a0e5,#015e94);background-color: #1275ff; border: 0px solid transparent; color: white; font-weight: 600" value="Cash On Delivery">
                      </form>
                  </td>
                </tr>
              </tfoot>
            </table>
          
        </div>
      </section>

    </div>
  </section>
  <!-- //payment page -->
  <!-- footer -->
  <?php include('./includes/footer.php') ?>
  <!-- script -->
  <?php include('./includes/script.php') ?>
  <!-- active -->
  <script type="text/javascript">
    function Get_Address() {
      document.getElementById('diachi_offline').value = document.getElementById('diachi').value;
  }
  </script>
</body>

</html>
