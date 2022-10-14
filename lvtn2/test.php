<?php
$mysqli = mysqli_connect(
  "localhost",
  "root",
  "",
  "lvtn2"
);
$sql = "SELECT * FROM SANPHAM WHERE MASANPHAM='Edra-361W'";
$result = $mysqli->query($sql);
while ($row = mysqli_fetch_assoc($result)) {
  extract($row);
  $post_arr['set_attributes'] = array(
    'MASANPHAM' => $MASANPHAM,
    'CHITIETSANPHAM' => $CHITIETSANPHAM,
  );
}
echo json_encode($post_arr);
$result->free_result();

$mysqli->close();
