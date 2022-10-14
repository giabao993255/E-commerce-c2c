<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('./includes/include.php');
require_once('./includes/conn.php');

$sql = "SELECT * FROM SANPHAM WHERE MASANPHAM='Edra-361W'";
$result = Check_db($sql);
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    $post_arr['set_attributes'] = array(
        'MASANPHAM' => $MASANPHAM,
        'CHITIETSANPHAM' => $CHITIETSANPHAM,
    );
}
echo json_encode($post_arr);
