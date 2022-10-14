<?php 
    require_once('./include.php');
    require_once('./conn.php');
    // use Stripe\lib\Stripe;
    require_once('vendor/autoload.php');
    require_once('/path/to/stripe-php/init.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <table>
            <tr>
                <td>Số thẻ: </td>
                <td><input type="text" name="sothe" required></td>
            </tr>
            <tr>
                <td>Tháng hết hạn: </td>
                <td><input type="text" name="thanghethan" required></td>
            </tr>
                <td>Năm hết hạn: </td>
                <td><input type="text" name="namhethan" required></td>
            </tr>
            <tr>
                <td>Mã xác thực: </td>
                <td><input type="text" name="maxacthuc" required></td>
            </tr>
            <tr>
                <td><input type="submit" name="thanhtoan" value="Thanh toán"></td>
            </tr>
        </table>
    </form>
</body>
</html>

<!-- <html>
  <head>
    <title>Buy cool new product</title>
  </head>
  <body>
    <button id="checkout-button">Checkout</button>

    <script type="text/javascript">
      // Create an instance of the Stripe object with your publishable API key
      var stripe = Stripe('pk_test_51IndjBESEH2pPC47GMUV8ag12NjHGSslPvKrQVbWz7DeLVozbJ16HWBnCPvvVA1yDTYZVDSYpig3Ft15mZI8rL9v00HpxCfeGh');
      var checkoutButton = document.getElementById('checkout-button');

      checkoutButton.addEventListener('click', function() {
        // Create a new Checkout Session using the server-side endpoint you
        // created in step 3.
        fetch('/create-checkout-session', {
          method: 'POST',
        })
        .then(function(response) {
          return response.json();
        })
        .then(function(session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function(result) {
          // If `redirectToCheckout` fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using `error.message`.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function(error) {
          console.error('Error:', error);
        });
      });
    </script>
  </body>
</html> -->

<?php
    if(isset($_POST['thanhtoan'])){
        $sothe = Get_value($_POST['sothe']);
        $thanghethan = Get_value($_POST['thanghethan']);
        $namhethan = Get_value($_POST['namhethan']);
        $maxacthuc = Get_value($_POST['maxacthuc']);
        $token = CreateToken($sothe, $thanghethan, $namhethan, $maxacthuc);
        CreateCharge($token, 10000, 'HD01', 'ok');
    }

    function CreateToken($number, $expMonth, $expYear, $CVC){
        $stripe = new StripeClient(
            'sk_test_51IndjBESEH2pPC47ixflWb5Rn9EuQUVG7mb0nf5BSEqnxkegixv0z1tsRTBUWtV6YKZkwoDVDk34RFwbvBfxjxuw000N1kj6hv'
        );
            $stripe->tokens->create([
            'card' => [
                'number' => $number,
                'exp_month' => $expMonth,
                'exp_year' => $expYear,
                'cvc' => $CVC,
            ],
        ]);
        return $stripe->token_name;
    }
        
    function CreateCharge($token, $amount, $orderId, $description){
        $stripe = new StripeClient(
            'sk_test_51IndjBESEH2pPC47ixflWb5Rn9EuQUVG7mb0nf5BSEqnxkegixv0z1tsRTBUWtV6YKZkwoDVDk34RFwbvBfxjxuw000N1kj6hv'
        );
        $stripe->charges->create([
            'amount' => $amount, //int
            'currency' => 'vnd',
            'source' => $token,
            'description' => $description,
            "metadata" => ["order_id" => $orderId]
        ]);
    }
    
?>

<!-- <?php
// This example sets up an endpoint using the Slim framework.
// Watch this video to get started: https://youtu.be/sGcNPFX1Ph4.

use Slim\Http\Request;
use Slim\Http\Response;
// use Stripe\Stripe;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app->add(function ($request, $response, $next) {
  \Stripe\Stripe::setApiKey('sk_test_51IndjBESEH2pPC47ixflWb5Rn9EuQUVG7mb0nf5BSEqnxkegixv0z1tsRTBUWtV6YKZkwoDVDk34RFwbvBfxjxuw000N1kj6hv');
  return $next($request, $response);
});

$app->post('/create-checkout-session', function (Request $request, Response $response) {
  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => 'T-shirt',
        ],
        'unit_amount' => 2000,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://example.com/success',
    'cancel_url' => 'https://example.com/cancel',
  ]);

  return $response->withJson([ 'id' => $session->id ])->withStatus(200);
});

$app->run(); ?>-->