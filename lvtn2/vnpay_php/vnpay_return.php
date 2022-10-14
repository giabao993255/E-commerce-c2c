<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>VNPAY RESPONSE</title>
    <!-- Bootstrap core CSS -->
    <link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
    <script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
</head>

<body>
    <?php
    require_once("./config.php");
    require_once('./../includes/include.php');
    require_once('./../includes/conn.php');
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    ?>
    <!--Begin display -->
    <!-- <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">VNPAY RESPONSE</h3>
            </div>
            <div class="table-responsive">
                <div class="form-group">
                    <label >Mã đơn hàng:</label>

                    <label><?php
                            // echo $_GET['vnp_TxnRef'] 
                            ?></label>
                </div>    
                <div class="form-group">

                    <label >Số tiền:</label>
                    <label><?php
                            // echo $_GET['vnp_Amount'] 
                            ?></label>
                </div>  
                <div class="form-group">
                    <label >Nội dung thanh toán:</label>
                    <label><?php
                            // echo $_GET['vnp_OrderInfo'] 
                            ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã phản hồi (vnp_ResponseCode):</label>
                    <label><?php
                            // echo $_GET['vnp_ResponseCode'] 
                            ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã GD Tại VNPAY:</label>
                    <label><?php
                            // echo $_GET['vnp_TransactionNo'] 
                            ?></label>
                </div> 
                <div class="form-group">
                    <label >Mã Ngân hàng:</label>
                    <label><?php
                            // echo $_GET['vnp_BankCode'] 
                            ?></label>
                </div> 
                <div class="form-group">
                    <label >Thời gian thanh toán:</label>
                    <label><?php
                            // echo $_GET['vnp_PayDate'] 
                            ?></label>
                </div> 
                <div class="form-group">
                    <label >Kết quả:</label>
                    <label> -->
    <?php
    if ($secureHash == $vnp_SecureHash) {
        if ($_GET['vnp_ResponseCode'] == '00') {
            $ngayxuat = date('Y-m-d');
            $taikhoan = $_SESSION['taikhoan'];
            $madonxuat = time() . "_" . $taikhoan;
            $sql_giohang = "SELECT * FROM GIOHANG, SANPHAM WHERE GIOHANG.MASANPHAM = SANPHAM.MASANPHAM AND TAIKHOAN = '$taikhoan'";
            $res_giohang = Check_db($sql_giohang);
            while ($row_giohang = mysqli_fetch_assoc($res_giohang)) {
                $masanpham_giohang = $row_giohang['MASANPHAM'];
                $sql_ktgg = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masanpham_giohang' AND now() BETWEEN GIAMGIA.thoigianapdung AND GIAMGIA.thoigianketthuc";
                $res_ktgg = Check_db($sql_ktgg);
                if (mysqli_num_rows($res_ktgg) > 0) {
                    while ($row_ktgg = mysqli_fetch_assoc($res_ktgg)) {
                        $giatien = $row_giohang['GIASANPHAM'] - $row_giohang['GIASANPHAM'] * $row_ktgg['TILEGIAMGIA'] / 100;
                        $soluongsanpham = $row_giohang['SOLUONGSANPHAM'];
                        $sql_xuathang = "INSERT INTO `hoadonxuat`(`MADONXUAT`,`TAIKHOAN`, `NGAYXUAT`, `MASANPHAM`, `GIATIEN`, `SOLUONGSANPHAM`, `TRANGTHAI`) VALUES ('$madonxuat','$taikhoan','$ngayxuat','$masanpham_giohang','$giatien','$soluongsanpham', 'soạn hàng');";
                        if ($res_xuathang = Check_db($sql_xuathang)) {
                            $sql_xoagiohang = "DELETE FROM `giohang` WHERE TAIKHOAN = '$taikhoan'";
                            if ($res_xoagiohang = Check_db($sql_xoagiohang)) {
                                // //     $sql_taikhoan = "SELECT * FROM NGUOIDUNG WHERE TAIKHOAN = '$taikhoan'";
                                // //     $res_taikhoan = Check_db($sql_taikhoan);
                                // //     $row_taikhoan = mysqli_fetch_assoc($res_taikhoan);
                                // //     $email_taikhoan = $row_taikhoan['email'];
                                // //     $ten_taikhoan = $row_taikhoan['hoten'];
                                // //     $to_email = $email_taikhoan;
                                // //     $subject = "Hóa đơn điện tử";
                                // //     $body = "
                                // //     Kính gửi QUÝ CÔNG TY/KHÁCH HÀNG: " . $ten_taikhoan . "

                                // //     ClickBuy xin trân trọng cảm ơn Quý khách hàng đã xử dụng sản phẩm và dịch vụ của chúng tôi.

                                // //     Hóa đơn điện tử của Quý khách đã được phát hành bởi ClickBuy, chi tiết như sau :

                                // //     - Sản phẩm mua: " . $masanpham_giohang . "

                                // //     - Giá sản phẩm: " . number_format($giatien, 0, '', ',') . "

                                // //     - Số lượng mua: " . $soluongsanpham . "

                                // //     - Tổng tiền đã thanh toán: " . number_format($soluongsanpham * $giatien, 0, '', ',') . "

                                // //     - Ngày đặt hàng: " . $ngayxuat . "

                                // //     Trân trọng !

                                // //     Đây là Email tự động, quý khách vui lòng không trả lời Email này .";

                                // //     $headers = "From: ClickBuy Bot";
                                // //     if (mail($to_email, $subject, $body, $headers)) {
                                header('Location: http://localhost/lvtn2/trangcanhan.php');
                            }
                            // //     } else {
                            // //         echo "Email sending failed...";
                            // //     }
                            // // }
                        }
                    }
                } else {
                    $giatien = $row_giohang['GIASANPHAM'];
                    $soluongsanpham = $row_giohang['SOLUONGSANPHAM'];
                    $sql_xuathang = "INSERT INTO `hoadonxuat`(`MADONXUAT`,`TAIKHOAN`, `NGAYXUAT`, `MASANPHAM`, `GIATIEN`, `SOLUONGSANPHAM`, `TRANGTHAI`) VALUES ('$madonxuat','$taikhoan','$ngayxuat','$masanpham_giohang','$giatien','$soluongsanpham', 'soạn hàng');";
                    if ($res_xuathang = Check_db($sql_xuathang)) {
                        $sql_xoagiohang = "DELETE FROM `giohang` WHERE TAIKHOAN = '$taikhoan'";
                        if ($res_xoagiohang = Check_db($sql_xoagiohang)) {
                            //     $sql_taikhoan = "SELECT * FROM NGUOIDUNG WHERE TAIKHOAN = '$taikhoan'";
                            //     $res_taikhoan = Check_db($sql_taikhoan);
                            //     $row_taikhoan = mysqli_fetch_assoc($res_taikhoan);
                            //     $email_taikhoan = $row_taikhoan['EMAIL'];
                            //     $ten_taikhoan = $row_taikhoan['HOTEN'];
                            //     $to_email = $email_taikhoan;
                            //     $subject = "Hóa đơn điện tử";
                            //     $body = "
                            //     Kính gửi QUÝ CÔNG TY/KHÁCH HÀNG: " . $ten_taikhoan . "

                            //     ClickBuy xin trân trọng cảm ơn Quý khách hàng đã xử dụng sản phẩm và dịch vụ của chúng tôi.

                            //     Hóa đơn điện tử của Quý khách đã được phát hành bởi ClickBuy, chi tiết như sau :

                            //     - Sản phẩm mua: " . $masanpham_giohang . "

                            //     - Giá sản phẩm: " . $giatien . "

                            //     - Số lượng mua: " . $soluongsanpham . "

                            //     - Tổng tiền đã thanh toán: " . $soluongsanpham * $giatien . "

                            //     - Ngày đặt hàng: " . $ngayxuat . "

                            //     Trân trọng !

                            //     Đây là Email tự động, quý khách vui lòng không trả lời Email này .";

                            //     $headers = "From: ClickBuy Bot";
                            //     if (mail($to_email, $subject, $body, $headers)) {
                            header('Location: http://localhost/lvtn2/trangcanhan.php');
                        }
                        //     } else {
                        //         echo "Email sending failed...";
                        //     }
                        // }
                    }
                }
            };
        } else {
            header('Location: http://localhost/lvtn2/thanhtoan.php');
        }
    } else {
        header('Location: http://localhost/lvtn2/thanhtoan.php');
    }
    ?>
    <!-- 
                    </label>
                </div> 
            </div>
            <p>
                &nbsp;
            </p>
            <footer class="footer">
                   <p>&copy; VNPAY <?php echo date('Y') ?></p>
            </footer> -->
    </div>
</body>

</html>