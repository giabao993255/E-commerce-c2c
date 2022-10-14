<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>
<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách khách hàng</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <table id="dataid" class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Tài khoản</th>
                    <th class="text-center">Họ và tên</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Địa chỉ</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_all_cus = "SELECT * FROM NGUOIDUNG WHERE MAQUYEN = 'KH'";
                $res_all_cus = Check_db($sql_all_cus);
                while ($row = mysqli_fetch_array($res_all_cus)) {
                    $taikhoan = $row['TAIKHOAN'];
                    $tennd = $row['HOTEN'];
                    $sdt = $row['SDT'];
                    $diachi = $row['DIACHI'];
                    $email = $row['EMAIL'];
                ?>
                    <tr>
                        <td class="text-center"><?php echo $taikhoan; ?></td>
                        <td class="text-center"><?php echo $tennd; ?></td>
                        <td class="text-center"><?php echo $sdt; ?></td>
                        <td class="text-center"><?php echo $diachi ?></td>
                        <td class="text-center"><?php echo $email ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="index.php?action=xemgiohang&taikhoan=<?php echo $taikhoan ?>">Xem giỏ hàng</a>
                            <a href="index.php?action=xemlichsumuahang&taikhoan=<?php echo $taikhoan ?>" class="btn btn-primary">Xem lịch sử mua hàng</a>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>