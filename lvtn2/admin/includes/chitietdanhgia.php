<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
$madanhgia = $_GET['madanhgia'];
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết đánh giá sản phẩm: <?php
                                                                        $sql_sanpham = "SELECT DISTINCT * FROM DANHGIA, SANPHAM WHERE DANHGIA.MASANPHAM = SANPHAM.MASANPHAM AND MADANHGIA = '$madanhgia'";
                                                                        $res_sanpham = Check_db($sql_sanpham);
                                                                        $row_sanpham  = mysqli_fetch_assoc($res_sanpham);
                                                                        $tensanpham = $row_sanpham['TENSANPHAM'];
                                                                        echo $tensanpham
                                                                        ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <table class="table table-border" width="100%">
        <thead>
            <tr>
                <th class="text-center">Tài khoản</th>
                <th class="text-center">Nội dung</th>
                <th class="text-center">Thời gian</th>
            </tr>
            <tr>
                <?php
                $sql_danhgia = "SELECT * FROM DANHGIA WHERE MADANHGIA = '$madanhgia'";
                $res_danhgia = Check_db($sql_danhgia);
                $row_danhgia = mysqli_fetch_assoc($res_danhgia);
                $taikhoan_danhgia = $row_danhgia['TAIKHOAN'];
                $noidung_danhgia = $row_danhgia['NOIDUNG'];
                $thoigian_danhgia = $row_danhgia['THOIGIANDANHGIA'];
                ?>
                <th class="text-center"><?php echo $taikhoan_danhgia; ?></th>
                <th class="text-center"><?php echo $noidung_danhgia; ?></th>
                <th class="text-center"><?php echo $thoigian_danhgia; ?></th>
            </tr>
        </thead>
        <?php
        $sql_traloi = "SELECT * FROM TRALOIDANHGIA WHERE MADANHGIA = '$madanhgia'";
        $res_traloi = Check_db($sql_traloi);
        while ($row_traloi = mysqli_fetch_array($res_traloi)) {
            $TAIKHOAN_TRALOI = $row_traloi['TAIKHOAN'];
            $NOIDUNGTRALOI = $row_traloi['NOIDUNGTRALOI'];
            $THOIGIANTRALOI = $row_traloi['THOIGIANTRALOI'];
        ?>
            <tbody>
                <tr>
                    <td class="text-center"><?php echo $TAIKHOAN_TRALOI; ?></td>
                    <td class="text-center"><?php echo $NOIDUNGTRALOI; ?></td>
                    <td class="text-center"><?php echo $THOIGIANTRALOI ?></td>
                </tr>
            </tbody>
        <?php
        }
        ?>
    </table>
    <hr>
    <h3 class="text-center">Trả lời đánh giá</h3>
    <form action="" method="POST">
        <textarea class="col-12" name="noidungtraloi" id="noidungtraloi" rows="5" style="resize: none;" required></textarea>
        <button class="col-12 btn btn-primary" name="traloi" type="submit">Trả lời</button>
    </form>
</div>

<?php
if (isset($_POST['traloi'])) {
    $noidungtraloi = $_POST['noidungtraloi'];
    $taikhoan = $_SESSION['taikhoan'];
    $thoigian = date('Y-m-d');
    $sql_update = "INSERT INTO `traloidanhgia`(`MADANHGIA`, `TAIKHOAN`, `NOIDUNGTRALOI`, `THOIGIANTRALOI`) VALUES ('$madanhgia','$taikhoan','$noidungtraloi','$thoigian')";
    $res_update = Check_db($sql_update);
    echo "<script>window.open('index.php?action=chitietdanhgia&madanhgia=$madanhgia','_self')</script>";
}
?>