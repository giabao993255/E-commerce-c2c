<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (isset($_POST['themhoadonnhap'])) {
    Check_f5($_POST['themhoadonnhap']);
}
?>

<div class="form_box">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm hóa đơn nhập hàng</h1>
    </div>
    <form method="post" class="justify-content-center">
        <table class="table table-border">
            <tr>
                <td valign="top"><b>Mã đơn nhập hàng:</b></td>
                <td>
                    <input type="text" name="madonnhap" id="madonnhap" required />
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Mã sản phẩm:</b></td>
                <td><input type="text" name="masp" id="masp" required />
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Số lượng nhập:</b></td>
                <td>
                    <input type="number" name="soluongnhap" id="soluongnhap" required>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Giá sản phẩm:</b></td>
                <td>
                    <input type="number" name="giasanpham" id="giasanpham" required>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Nhà sản xuất:</b></td>
                <td>
                    <select id="mansx" name="mansx">
                        <?php
                        $sql_nsx = "SELECT * FROM NHASANXUAT";
                        $res_nsx = Check_db($sql_nsx);
                        while ($row = mysqli_fetch_array($res_nsx)) {
                            $manhasanxuat = $row['MANHASANXUAT'];
                            $tennhasanxuat = $row['TENNHASANXUAT'];
                            echo "<option value= '$manhasanxuat' >$tennhasanxuat</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Thời gian nhập: </b></td>
                <td>
                    <input type="date" name="thoigiannhap" id="thoigiannhap" size=60 required max=''>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <input type="submit" class="btn-submit btn btn-primary" name="themhoadonnhap" value="Thêm đơn nhập hàng">
                </td>
            </tr>
        </table>
    </form>
</div>
<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("thoigiannhap").setAttribute("max", today);
</script>
<?php
if (isset($_POST['themhoadonnhap'])) {
    $madonnhap = $_POST["madonnhap"];
    $masp = $_POST["masp"];
    $nsx = $_POST["mansx"];
    $soluongnhap = $_POST["soluongnhap"];
    $giasanpham = $_POST["giasanpham"];
    $thoigian = strtotime($_POST['thoigiannhap']);
    if ($thoigian) {
        $thoigiannhap = date('Y-m-d', $thoigian);
        $sql = "INSERT INTO `hoadonnhap` (`MADONNHAP`,`MASANPHAM`, `SOLUONGNHAP`, `GIASANPHAM`, `MANHASANXUAT`, `THOIGIANNHAP`) 
            VALUES ('$madonnhap','$masp', '$soluongnhap','$giasanpham', '$nsx', '$thoigiannhap');";
        $res = Check_db($sql);
        if ($res) {
            echo "<script>window.open('index.php?action=xemnhaphang','_self')</script>";
        } else {
            echo "<script>alert(\"Thêm thất bại\");</script>";
        }
    }
}
?>