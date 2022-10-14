<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_51IndjBESEH2pPC47ixflWb5Rn9EuQUVG7mb0nf5BSEqnxkegixv0z1tsRTBUWtV6YKZkwoDVDk34RFwbvBfxjxuw000N1kj6hv",
  "publishable_key" => "pk_test_51IndjBESEH2pPC47GMUV8ag12NjHGSslPvKrQVbWz7DeLVozbJ16HWBnCPvvVA1yDTYZVDSYpig3Ft15mZI8rL9v00HpxCfeGh",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>