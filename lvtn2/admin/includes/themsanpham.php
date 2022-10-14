<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (isset($_POST['themsanpham'])) {
    Check_f5($_POST['themsanpham']);
}
$ma_sp_chuaHT = '';
?>

<div class="form_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm sản phẩm</h1>
    </div>
    <form method="post" enctype="multipart/form-data" class="justify-content-center">

        <table class="table table-border">
            <tr>
                <td valign="top"><b>Mã sản phẩm:</b></td>
                <td>
                    <select id="masanpham" name="masanpham">
                        <?php
                        $sql_sp_chuaHT = "SELECT HOADONNHAP.MASANPHAM
                        FROM hoadonnhap
                        LEFT JOIN sanpham ON HOADONNHAP.MASANPHAM = SANPHAM.MASANPHAM WHERE SANPHAM.HIENTHI IS NULL";
                        $res_sp_chuaHT = Check_db($sql_sp_chuaHT);
                        while ($row = mysqli_fetch_assoc($res_sp_chuaHT)) {
                            $ma_sp_chuaHT = $row['MASANPHAM'];
                            echo "<option>$ma_sp_chuaHT</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Tên sản phẩm:</b></td>
                <td><input type="text" name="tensp" id="tensp" size=60 required />
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Giá sản phẩm:</b></td>
                <td>
                    <input type="number" name="giasp" id="giasp" min=20 size=60 required />
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Tên loại sản phẩm:</b></td>
                <td>
                    <select id="maloaisp" name="maloaisp">
                        <?php
                        $sql_all_cat = "SELECT * FROM LOAISANPHAM";
                        $res_all_cat = Check_db($sql_all_cat);
                        while ($row = mysqli_fetch_assoc($res_all_cat)) {
                            $maloaisp = $row['MALOAISANPHAM'];
                            $tenloaisp = $row['TENLOAISANPHAM'];
                            echo '<option value=', $maloaisp, '>', $tenloaisp, '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Mã giảm giá: </b></td>
                <td>
                    <select id="magiamgia" name="magiamgia">
                        <option value=''>Không </option>
                        <?php
                        $sql_all_discount = "SELECT * FROM GIAMGIA 
                        WHERE now() BETWEEN thoigianapdung AND thoigianketthuc";
                        $res_all_discount = Check_db($sql_all_discount);
                        while ($row = mysqli_fetch_array($res_all_discount)) {
                            $magiamgia = $row['MAGIAMGIA'];
                            echo "<option value= '$magiamgia' >$magiamgia</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Mô tả sản phẩm: </b></td>
                <td>
                    <textarea name="motasanpham" id="motasanpham" cols="60" rows="10" style="resize:none" required></textarea>
                </td>
            </tr>
            <tr>
                <td><b>Hình ảnh: </b></td>
                <td><input type="file" name="files[]" multiple required /></td>
            </tr>
            <tr>
                <td class="text-center">
                    <?php
                    if ($ma_sp_chuaHT == '') {
                    ?>
                        <input type="submit" class="btn-submit btn btn-primary" name="themsanpham" value="Thêm sản phẩm" disabled>
                    <?php
                    } else {
                    ?>
                        <input type="submit" class="btn-submit btn btn-primary" name="themsanpham" value="Thêm sản phẩm">
                    <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
if (isset($_POST['themsanpham'])) {
    $masanpham = Get_value($_POST["masanpham"]);
    $tensp = Get_value($_POST["tensp"]);
    $giasp = Get_value($_POST['giasp']);
    $maloaisp = Get_value($_POST["maloaisp"]);
    $magiamgia = Get_value($_POST["magiamgia"]);
    $motasanpham = Get_value($_POST["motasanpham"]);
    $thoigianhienthi = date("Y-m-d");
    $uploads_dir = '/uploads';
    $temp = 0;
    $sql_nsx = "SELECT MANHASANXUAT FROM HOADONNHAP WHERE MASANPHAM = '$ma_sp_chuaHT'";
    $res_nsx = Check_db($sql_nsx);
    $row_nsx = mysqli_fetch_assoc($res_nsx);
    $nsx = $row_nsx['MANHASANXUAT'];
    foreach ($_FILES['files']['type'] as $key => $value) {
        $value = substr($value, 0, 5);
        if ($value != "image") {
            $temp++;
        }
    }
    if ($temp == 0) {
        $sql_timsp = "SELECT * FROM SANPHAM WHERE MASANPHAM = '$masanpham' AND HIENTHI = '0'";
        $res_timsp = Check_db($sql_timsp);
        if (mysqli_num_rows($res_timsp) > 0) {
            $sql_cnsp = "UPDATE `sanpham` SET `HIENTHI`='1',`THOIGIANHIENTHI`='$thoigianhienthi' WHERE MASANPHAM = '$masanpham'";
            $res_cnsp = Check_db($res_cnsp);
        } else {
            if ($magiamgia == "") {
                $sql = "INSERT INTO `SANPHAM` (`MASANPHAM`,`TENSANPHAM`, `GIASANPHAM`, `CHITIETSANPHAM`, `MALOAISANPHAM`, `MANHASANXUAT`, `HIENTHI`, `THOIGIANHIENTHI`) 
                VALUES ('$masanpham','$tensp','$giasp', '$motasanpham', '$maloaisp', '$nsx', '1', '$thoigianhienthi');";
            } else {
                $sql = "INSERT INTO `SANPHAM` (`MASANPHAM`,`TENSANPHAM`, `GIASANPHAM`, `CHITIETSANPHAM`, `MALOAISANPHAM`, `MANHASANXUAT`, `MAGIAMGIA`, `HIENTHI`, `THOIGIANHIENTHI`) 
                VALUES ('$masanpham','$tensp','$giasp', '$motasanpham', '$maloaisp', '$nsx', '$magiamgia', '1', '$thoigianhienthi');";
            }
            $conn = Connect();
            $res = mysqli_query($conn, $sql);
            mysqli_close($conn);
            foreach ($_FILES["files"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["files"]["tmp_name"][$key];
                    $name = basename($_FILES["files"]["name"][$key]);
                    move_uploaded_file($tmp_name, "./../hinhanh/$name");
                    $sql_hinh = "INSERT INTO HINHANHSANPHAM (MASANPHAM, DUONGDAN) VALUES ('$masanpham', '$name');";
                    $conn = Connect();
                    $themhinh = mysqli_query($conn, $sql_hinh);
                    mysqli_close($conn);
                }
            }
            if ($themhinh) {
                echo "<script>alert('Thêm sản phẩm thành công');</script>";
                echo "<script>window.open('index.php?action=xemsanpham','_self')</script>";
            } else {
                echo "<script>alert('Thêm sản phẩm thất bại');</script>";
            }
        }
    } else {
        echo "<script>alert('Định dạng hình không đúng');</script>";
    }
}
?>