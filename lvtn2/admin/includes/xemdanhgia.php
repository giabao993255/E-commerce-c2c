<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
?>

<div class="view_product_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách đánh giá sản phẩm</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Tải báo cáo
        </a> -->
    </div>
    <table id="dataid" class="table table-bordered" width="100%">
        <thead>
            <tr>
                <th class="text-center">Tài khoản</th>
                <th class="text-center">Điểm</th>
                <th class="text-center">Nội dung đánh giá</th>
                <th class="text-center">Thời gian đánh giá</th>
                <th class="text-center">Số phản hồi</th>
                <th class="text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_danhgia = "SELECT * FROM DANHGIA ORDER BY THOIGIANDANHGIA DESC";
            $res_sql_danhgia = Check_db($sql_danhgia);
            while ($row_danhgia = mysqli_fetch_array($res_sql_danhgia)) {
                $ma_danhgia = $row_danhgia['MADANHGIA'];
                $taikhoan_danhgia = $row_danhgia['TAIKHOAN'];
                $diem_danhgia = $row_danhgia['DIEMDANHGIA'];
                $noidung_danhgia = $row_danhgia['NOIDUNG'];
                $thoigian_danhgia = $row_danhgia['THOIGIANDANHGIA'];
                $sql_phanhoi = "SELECT COUNT(TAIKHOAN) FROM TRALOIDANHGIA WHERE MADANHGIA = '$ma_danhgia'";
                $res_phanhoi = Check_db($sql_phanhoi);
                if (mysqli_num_rows($res_phanhoi) > 0) {
                    $row_phanhoi = mysqli_fetch_array($res_phanhoi);
                    $solan_phanhoi = $row_phanhoi['COUNT(TAIKHOAN)'];
            ?>
                    <tr>
                        <td class="text-center"><?php echo $taikhoan_danhgia ?></td>
                        <td class="text-center"><?php echo $diem_danhgia ?></td>
                        <td class="text-center"><?php echo $noidung_danhgia ?></td>
                        <td class="text-center"><?php echo $thoigian_danhgia ?></td>
                        <td class="text-center"><?php echo $solan_phanhoi ?> </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-submit btn-sm" href="index.php?action=chitietdanhgia&madanhgia=<?php echo $ma_danhgia ?>">Chi tiết</a>
                        </td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $taikhoan_danhgia ?></td>
                        <td class="text-center"><?php echo $diem_danhgia ?></td>
                        <td class="text-center"><?php echo $noidung_danhgia ?></td>
                        <td class="text-center"><?php echo $thoigian_danhgia ?> </td>
                        <td class="text-center"> 0 </td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-submit btn-sm" href="index.php?action=chitietdanhgia&madanhgia=<?php echo $ma_danhgia ?>">Chi tiết</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php
if (isset($_POST['delete_product'])) {
    $masanpham = $_POST['masanpham'];
    echo $masanpham;
    // $sql_del_img = "DELETE FROM HINHANH WHERE MASANPHAM = '$masp';";
    // $delete = Check_db($sql_del_img);
    // if ($delete) {
    $sql_del_product = "DELETE FROM SANPHAM WHERE MASANPHAM = '$masanpham';";
    if (Check_db($sql_del_product)) {
        echo "<script>alert('xóa sản phẩm thành công!')</script>";
        echo "<script>window.open('index.php?action=xemsanpham','_self')</script>";
    } else {
        echo "<script>alert('xóa sản phẩm thất bại!')</script>";
    }
    // } else {
    //     echo "<script>alert('xóa sản phẩm thất bại!')</script>";
    // }
}
?>

<?php

// function Check_Product($masp)
// {
//     if (isset($_POST['ktsp'])) {
//         $sql = "SELECT * FROM SANPHAM WHERE MASANPHAM = '$masp';";
//         $res = Check_db($sql);
//         if (mysqli_num_rows($res) > 0) {
//             return true;
//         } else {
//             return false;
//         }
//     }
// }

// function View_Product_Sellest()
// {
//     $sql = "SELECT * FROM sanpham where Masp = (select max(soluongdat) FROM monhang);";
//     $res = Check_db($sql);
//     if (mysqli_num_rows($res) > 0) {
//         while ($row = mysqli_fetch_assoc($res)) {
//             $masp = $row['MASP'];
//             $tensp = $row['TENSP'];
//             $gia = $row['GIA'];
//             $phantram = View_Discount_Of_Product($masp);
//             $kichthuocmh = $row['KICHTHUOCMH'];
//             $vixuly = $row['VIXULY'];
//             $ram = $row['RAM'];
//             $motasp = $row['MOTASP'];
//             $ngaysx = $row['NGAYSX'];
//         }
//     } else {
//         echo "khong tin duoc san pham ban chay nhat";
//     }
// }

// function View_Full_Product()
// {
//     $sql = "SELECT * FROM sanpham";
//     $res = Check_db($sql);
//     if (mysqli_num_rows($res) > 0) {
//         while ($row = mysqli_fetch_assoc($res)) {
//             $masp = $row['MASP'];
//             $tensp = $row['TENSP'];
//             $gia = $row['GIA'];
//             $phantram = View_Discount_Of_Product($masp);
//             $phantram = $row['PHANTRAM'];
//             $kichthuocmh = $row['KICHTHUOCMH'];
//             $vixuly = $row['VIXULY'];
//             $ram = $row['RAM'];
//         }
//     } else {
//         echo "khong tim duoc san pham nao";
//     }
// }

// function View_full_loai_Of_Product($masp)
// {
//     $sql_loai = "SELECT * FROM SANPHAM WHERE MALOAISP = (SELECT MALOAISP FROM SANPHAM WHERE MASP = '$masp')";
//     $res_loai = Check_db($sql_loai);
//     if (mysqli_num_rows($res_loai) > 0) {
//         while ($row_loai = mysqli_fetch_assoc($res_loai)) {
//             $maloaisp = $row_loai['maloaisp'];
//         }
//     } else {
//         echo "khong co loai nao";
//     }
// }

// function View_full_MaNSX_Of_Product($masp)
// {
//     $sql_NSX = "SELECT * FROM SANPHAM WHERE MANSX = (SELECT MANSX FROM SANPHAM WHERE MASP = '$masp')";
//     $res_NSX = Check_db($sql_NSX);
//     if (mysqli_num_rows($res_NSX) > 0) {
//         while ($row_NSX = mysqli_fetch_assoc($res_NSX)) {
//             $maNSX = $row_NSX['maNSX'];
//         }
//     } else {
//         echo "khong co NSX nao";
//     }
// }

?>