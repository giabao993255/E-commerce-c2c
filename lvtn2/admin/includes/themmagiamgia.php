<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');

?>
<div class="form_box">
    <h2>Thêm giảm giá</h2>
    <form onsubmit="return Check_all()" method="post" enctype="multipart/form-data">

        <table class="table tabler-border" width="100%">
            <tr>
                <td valign="top"><b>Mã giảm giá: </b></td>
                <td><input type="text" name="magiamgia" id="magiamgia" /></td>
            </tr>
            <tr>
                <td valign="top"><b>Tên giảm giá: </b></td>
                <td><input type="text" name="tengiamgia" id="tengiamgia" required /></td>
            </tr>

            <tr>
                <td valign="top"><b>Tỉ lệ giảm giá: </b></td>
                <td>
                    <input type="number" name="tilegiamgia" id="tilegiamgia" min="0" max="100" required />
                    <span>%</span>
                </td>
            </tr>
            <tr>
                <th>Thời gian áp dụng:</th>
                <td><input type="date" name="thoigianapdung" id="thoigianapdung"></td>
            </tr>
            <tr>
                <th>Thời gian kết thúc:</th>
                <td><input type="date" name="thoigianketthuc" id="thoigianketthuc"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="submit" class="btn btn-primary" name="themmagiamgia" value="Thêm giảm giá">
                </td>
            </tr>

        </table>
    </form>

</div>
<script>
    var today = new Date();
    var tomorrow;
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    // tomorrow = yyyy + '-' + mm + '-' + (dd + 1);
    document.getElementById("thoigianapdung").setAttribute("min", today);
    document.getElementById("thoigianketthuc").setAttribute("min", today);
</script>
<?php
if (isset($_POST['themmagiamgia'])) {
    $magiamgia = Get_value($_POST['magiamgia']);
    $tengiamgia = Get_value($_POST['tengiamgia']);
    $tilegiamgia = Get_value($_POST['tilegiamgia']);
    $thoigianbatdau = Get_value($_POST['thoigianapdung']);
    $thoigianketthuc = Get_value($_POST['thoigianketthuc']);
    if (strtotime($thoigianketthuc) - strtotime($thoigianbatdau) > 0) {
        $sql_add_discount = "INSERT INTO GIAMGIA (MAGIAMGIA, TENGIAMGIA, TILEGIAMGIA, THOIGIANAPDUNG, THOIGIANKETTHUC) value ('$magiamgia','$tengiamgia', '$tilegiamgia', '$thoigianbatdau', '$thoigianketthuc');";
        $res_add_discount = Check_db($sql_add_discount);
        if ($res_add_discount) {
            echo "<script>alert(\"Thêm giảm giá thành công\")</script>";
            echo "<script>window.open('index.php?action=xemmagiamgia','_self')</script>";
        }
    } else {
        echo "<script>alert(\"Ngày bắt đầu và kết thúc không hợp lệ!\")</script>";
    }
}

?>