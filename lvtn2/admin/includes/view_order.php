<?php 
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
?>

<div class="view_product_box">
    <h2>Chi tiết hóa đơn</h2>
    <div class="border_bottom"></div>
    <form action="" method="post" enctype="multipart/form-data">
        <table width="100%">
            <thead>
                <tr>
                    <th class="text-center">Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng đặt</th>
                    <th class="text-center">Đơn giá</th>
                </tr>
            </thead>
            <?php
                $res_detail = Order_detail($_GET['order_detail']);
                while ($row_detail = mysqli_fetch_array($res_detail)) {
                    $masp = $row_detail['MASP'];
                    $soluongdat = $row_detail['SOLUONGDAT'];
                    $sql_product = "SELECT * FROM SANPHAM WHERE MASP = '$masp'";
                    $res_product = Check_db($sql_product);
                    $row_product = mysqli_fetch_array($res_product);
                    $tensp = $row_product['TENSP'];
                    $gia = $row_product['GIA'];
            ?>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $masp; ?></td>
                    <td><?php echo $tensp; ?></td>
                    <td><?php echo $soluongdat; ?></td>
                    <td class="text-center">$<?php echo $gia; ?></td>
                </tr>
            </tbody>
            <?php
            } // End while loop 
            ?>
        </table>
    </form>
</div>

<?php 
    function Order_detail($madh){
        $sql_detail = "SELECT * FROM MONHANG WHERE MADH = '$madh'";
        $res_detail = Check_db($sql_detail);
        return $res_detail;
    }
?>