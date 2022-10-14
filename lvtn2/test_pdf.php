
<?php
require_once "./dompdf_1-2-1/dompdf/autoload.inc.php";
require_once "./includes/include.php";
require_once "./includes/conn.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$table_head = '<table class="table table-cart table-mobile">
<thead>
    <tr>
        <th class="text-center">San pham</th>
        <th class="text-center">Gia (VND)</th>
        <th class="text-center">So luong</th>
        <th class="text-center">Tong tien (VND)</th>
        <th class="text-center">Trang thai</th>
        <th class="text-center">Ngay mua</th>
    </tr>
</thead>

<tbody>';
$table_row_body = '';
$table_end_body = '';
$table_body = '';
$taikhoan = $_SESSION['taikhoan'];
$sql_xuathang_taikhoan = "SELECT * FROM HOADONXUAT WHERE TAIKHOAN = '$taikhoan'";
$res_xuathang_taikhoan = Check_db($sql_xuathang_taikhoan);
if (mysqli_num_rows($res_xuathang_taikhoan) > 0) {
    $taikhoan = $_SESSION['taikhoan'];
    $sql_xuathang = "SELECT * FROM HOADONXUAT, SANPHAM WHERE HOADONXUAT.MASANPHAM = SANPHAM.MASANPHAM AND HOADONXUAT.TAIKHOAN = '$taikhoan' ORDER BY HOADONXUAT.NGAYXUAT DESC";
    $res_xuathang = Check_db($sql_xuathang);
    while ($row_xuathang = mysqli_fetch_assoc($res_xuathang)) {
        $ngayxuat = $row_xuathang['NGAYXUAT'];
        $masp = $row_xuathang['MASANPHAM'];
        $tensp_xuathang = $row_xuathang['TENSANPHAM'];
        $soluongsanpham_xuathang = $row_xuathang['SOLUONGSANPHAM'];
        $giasanpham_xuathang = $row_xuathang['GIATIEN'];
        $trangthai_db = $row_xuathang['TRANGTHAI'];
        $tongtien = $soluongsanpham_xuathang * $giasanpham_xuathang;
        if ($trangthai_db == "soạn hàng") {
            $trangthai_show = "Chua giao";
        } else {
            $trangthai_show =  "Da giao";
        }
        $table_row_body = '<tr>
        <td>
            <h3 class="product-title">
                ' . $tensp_xuathang . '
            </h3>
        </td>
        <td class="text-center">' .  number_format($giasanpham_xuathang, 0, "", ",") . '</td>
        <td class="text-center">
            <div class="cart-product-quantity">' .  $soluongsanpham_xuathang . '
            </div>
        </td>
        <td class="text-center">' .  number_format($soluongsanpham_xuathang * $giasanpham_xuathang, 0, "", ",") . '</td>
        <td class="text-center">
            ' . $trangthai_show . '
        </td>
        <td class="text-center">
        ' .  $ngayxuat . ' 
        </td>
    </tr>';
        $table_body = $table_body . $table_row_body;
    }
    $table_end_body = '
    </tbody>
    </table>';
}
$full = $table_head . $table_body . $table_end_body;

$dompdf->loadHtml($full);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("Stream", array("Attachment" => 0));
?>