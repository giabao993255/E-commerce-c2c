<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (!isset($_SESSION['taikhoan'])) {
	header('Location: login.php');
}
$taikhoan = $_SESSION['taikhoan'];
$sql_taikhoan = "SELECT * FROM NGUOIDUNG WHERE TAIKHOAN = '$taikhoan'";
$res_taikhoan = Check_db($sql_taikhoan);
$row_taikhoan = mysqli_fetch_array($res_taikhoan);
$tennd = $row_taikhoan['HOTEN'];
$diachind = $row_taikhoan['DIACHI'];
$sdtnd = $row_taikhoan['SDT'];
$email = $row_taikhoan['EMAIL'];
$tongtien = 0;
$tongsanpham = "";
?>

<!DOCTYPE html>
<html lang="en">
<?php include('./includes/head.php') ?>

<body>
	<!-- header -->
	<?php include('./includes/header.php') ?>

	<main class="main">
		<div class="page-content">
			<div class="checkout">
				<div class="container">
					<form action="./includes/codethanhtoan.php" method="POST">
						<div class="row">
							<div class="col-lg-9">
								<h2 class="checkout-title">Thông tin đặt hàng</h2>
								<label>Họ và tên *</label>
								<input type="text" class="form-control" required value="<?php echo $tennd ?>" disabled>
								<label>Địa chỉ *</label>
								<input type="text" class="form-control" value="<?php echo $diachind ?>" disabled>
								<label>Số điện thoại *</label>
								<input type="tel" class="form-control" required value="<?php echo $sdtnd ?>" disabled>
								<label>Địa chỉ email *</label>
								<input type="email" class="form-control" required value="<?php echo $email ?>" disabled>
							</div>
							<aside class="col-lg-3">
								<div class="summary">
									<h3 class="summary-title">Giỏ hàng của bạn</h3>
									<table class="table table-summary">
										<thead>
											<tr>
												<th>Sản phẩm</th>
												<th>Tổng cộng</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql_giohang = "SELECT DISTINCT * FROM GIOHANG, SANPHAM WHERE GIOHANG.MASANPHAM = SANPHAM.MASANPHAM AND TAIKHOAN = '$taikhoan' AND HIENTHI = 1";
											$res_giohang = Check_db($sql_giohang);
											while ($row_giohang = mysqli_fetch_assoc($res_giohang)) {
												$masp = $row_giohang['MASANPHAM'];
												$tensp_giohang = $row_giohang['TENSANPHAM'];
												$sql_tslsp = "SELECT SUM(SOLUONGSANPHAM) FROM GIOHANG WHERE MASANPHAM = '$masp' AND TAIKHOAN = '$taikhoan'";
												$tongsanpham = $row_giohang['MASANPHAM'] . " " . $tongsanpham;
												$res_tslsp = Check_db($sql_tslsp);
												$row_tslsp = mysqli_fetch_assoc($res_tslsp);
												$soluongsanpham_giohang = $row_tslsp['SUM(SOLUONGSANPHAM)'];
												$giasanpham_giohang = $row_giohang['GIASANPHAM'];
												$giahienthi = 0;
												$sql_mgg = "SELECT DISTINCT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
												$res_mgg = Check_db($sql_mgg);
												$row_mgg = mysqli_fetch_assoc($res_mgg);
												if ($row_mgg != '') {
													$mgg = $row_mgg['TILEGIAMGIA'];
												} else {
													$mgg = 0;
												}
												$giahienthi = $giasanpham_giohang - $giasanpham_giohang * $mgg / 100;
												$sql_hdn = "SELECT SUM(SOLUONGNHAP) FROM HOADONNHAP WHERE HOADONNHAP.MASANPHAM = '$masp'";
												$res_hdn = Check_db($sql_hdn);
												$sql_hdx = "SELECT SUM(SOLUONGSANPHAM) FROM HOADONXUAT WHERE HOADONXUAT.MASANPHAM = '$masp'";
												$res_hdx = Check_db($sql_hdx);
												$row1 = mysqli_fetch_array($res_hdn);
												$tongsoluongnhap = $row1['SUM(SOLUONGNHAP)'];
												if (mysqli_num_rows($res_hdx) > 0) {
													$tongsoluongban = 0;
													while ($row2 = mysqli_fetch_array($res_hdx)) {
														$tongsoluongban = $tongsoluongban + $row2['SUM(SOLUONGSANPHAM)'];
													}
													$max = $tongsoluongnhap - $tongsoluongban;
												} else {
													$max = $tongsoluongnhap;
												}
												if ($max > 0) {
													$tongtien = $tongtien + $giahienthi * $soluongsanpham_giohang;
											?>
													<tr>
														<td><a href="#"><?php echo $tensp_giohang ?> x <?php echo $soluongsanpham_giohang ?></a></td>
														<td><?php echo number_format($giahienthi * $soluongsanpham_giohang, 0, '', ',') ?> (VND)</td>
													</tr>
											<?php
												}
											}
											?>
											<tr class="summary-total">
												<td>Tổng:</td>
												<td><?php echo number_format($tongtien, 0, '', ',') ?> (VND)</td>
												<input type="hidden" name="tongsotienthanhtoan" value="<?php echo $tongtien ?>">
											</tr>
										</tbody>
									</table>
									<button type="submit" name="redirect" id="redirect" class="btn btn-outline-primary-2 btn-order btn-block">
										Tiến hành thanh toán
									</button>
								</div>
							</aside>
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>
	<?php include('./includes/footer.php') ?>
	<?php include('./includes/script.php') ?>


</body>