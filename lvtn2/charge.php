<?php
  require_once('./includes/config.php');


  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $tongtien = $_POST['tongtien']*100;
  // $taikhoan = $_SESSION['taikhoan'];
  // $ngaydat = date("Y-m-d");
  $mahd = uniqid();

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

  $charge = \Stripe\Charge::create([
      'customer' => $customer->id,
      'amount'   => $tongtien,
      'currency' => 'usd',
      'metadata' => ["order_id" => $mahd]
  ]);

  echo $charge;

  if($charge['status'] == 'succeeded'){
    $sql_status = "UPDATE `DONHANG` SET `HTTHANHTOAN` = 'Online' WHERE `MAHD` = '$mahd';";
    $res = Check_db($sql_status);
    if($res){
      echo "<script>alert('Thanh toán online thành công');</script>";
    }
  }
?>