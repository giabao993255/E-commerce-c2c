<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (isset($_POST['update_product'])) {
    Check_f5($_POST['update_product']);
}
$masp = $_GET['masanpham'];
$update_product = Check_db("SELECT * from SANPHAM where MASANPHAM='$masp'");
$fetch_update = mysqli_fetch_array($update_product);
$maloaisp = $fetch_update['MALOAISANPHAM'];
$magiamgia = $fetch_update['MAGIAMGIA'];
$tensp = $fetch_update['TENSANPHAM'];
$motasp = $fetch_update['CHITIETSANPHAM'];
$gia = $fetch_update['GIASANPHAM'];
?>
<div class="form_box">
    <h1 class="h3 mb-0 text-gray-800">Chi tiết sản phẩm</h1>
    <form method="post" enctype="multipart/form-data">
        <table class="table tabler-border" width="100%">
            <tr>
                <th>Tên sản phẩm:</th>
                <td><input type="text" name="tensp" id="tensx" size=60 value="<?php echo $tensp ?>" required />
                </td>
            </tr>
            <!-- <tr>
                <th>Tên loại loại sản phẩm:</th>
                <td>
                    <select id="maloaisp" name="maloaisp">
                        <?php
                        // $sql_all_cat = "SELECT * FROM LOAISANPHAM";
                        // $res_all_cat = Check_db($sql_all_cat);
                        // while ($row = mysqli_fetch_assoc($res_all_cat)) {
                        //     $maloaisp = $row['TENLOAISANPHAM'];
                        //     echo "<option>$maloaisp</option>";
                        // }
                        ?>
                    </select>
                </td>
            </tr> -->
            <tr>
                <th>Giảm giá: </th>
                <td>
                    <select id="magiamgia" name="magiamgia">
                        <?php
                        $sql_mggsp = "SELECT * FROM GIAMGIA, SANPHAM WHERE GIAMGIA.MAGIAMGIA = SANPHAM.MAGIAMGIA AND SANPHAM.MASANPHAM = '$masp' AND now() BETWEEN thoigianapdung AND thoigianketthuc";
                        $res_mggsp = Check_db($sql_mggsp);
                        if (mysqli_num_rows($res_mggsp) > 0) {
                            $row_mggsp = mysqli_fetch_array($res_mggsp);
                            $tilegiamgia_sp = $row_mggsp['TILEGIAMGIA'];
                            echo "<option value=''>$tilegiamgia_sp%</option>";
                            echo "<option value='0'>0%</option>";
                        } else {
                            echo "<option value='0'>0%</option>";
                            $sql_mgg = "SELECT * FROM GIAMGIA 
                                WHERE now() BETWEEN thoigianapdung AND thoigianketthuc";
                            $res_mgg = Check_db($sql_mgg);
                            while ($row = mysqli_fetch_array($res_mgg)) {
                                $tilegiamgia = $row['TILEGIAMGIA'];
                                $magiamgia = $row['MAGIAMGIA'];
                                echo "<option value='$magiamgia'>$tilegiamgia%</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Mô tả sản phẩm: </th>
                <td>
                    <textarea name="chitietsanpham" id="chitietsanpham" cols="60" rows="5" style="resize: none;"><?php echo $motasp ?></textarea>
                </td>
            </tr>

            <tr>
                <th>Giá:</th>
                <td>
                    <input type="number" min="0" name="gia" id="gia" value="<?php echo $gia; ?>" required>
                </td>
            </tr>
            <tr>
                <th>Hình ảnh: </th>
                <td>
                    <?php
                    $sql_img = "SELECT DUONGDAN FROM HINHANHSANPHAM WHERE MASANPHAM = '$masp'";
                    $res_img = Check_db($sql_img);
                    $row = mysqli_fetch_assoc($res_img);
                    $duongdan = $row['DUONGDAN'];
                    ?>
                    <img src="./../hinhanh/<?php echo $duongdan; ?>" alt="" width="1000px" height="500px">
                </td>
            </tr>

            <tr>
                <td colspan="13" class="text-center"><input class="btn btn-primary btn-submit" type="submit" name="update_product" value="Lưu" /></td>
            </tr>
        </table>
    </form>
</div>
<?php
if (isset($_POST['update_product'])) {
    $magiamgia_update = Get_value($_POST["magiamgia"]);
    $tensp_update = Get_value($_POST["tensp"]);
    $motasp_update = Get_value($_POST["chitietsanpham"]);
    $gia_update = Get_value($_POST["gia"]);
    $sql_cnsp = "UPDATE `sanpham` SET `TENSANPHAM`='$tensp_update',`GIASANPHAM`='$gia_update',`CHITIETSANPHAM`='$motasp_update',`MAGIAMGIA`='$magiamgia_update' WHERE MASANPHAM = '$masp'";
    if ($res = Check_db($sql_cnsp)) {
        echo "<script>alert(\"Cập nhật sản phẩm thành công\");</script>";
        echo "<script>window.open('index.php?action=xemsanpham','_self')</script>";
    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
}
?>