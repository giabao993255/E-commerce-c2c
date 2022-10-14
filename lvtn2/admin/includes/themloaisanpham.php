<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if (isset($_POST['themloaisp'])) {
    Check_f5($_POST['themloaisp']);
}
?>

<div class="form_box">
    <script>
    </script>
    <h2>Thêm Loại Sản Phẩm</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form method="post" enctype="multipart/form-data">

        <table class="table" width="100%">
            <tr>
                <td valign="top"><b>Mã loại sản phẩm:</b></td>
                <td><input type="text" name="maloaisp" id="maloaisp" required /></td>
            </tr>
            <tr>
                <td valign="top"><b>Tên loại sản phẩm:</b></td>
                <td> <input type="text" name="tenloaisp" id="tenloaisp" required /></td>
            </tr>
            <tr>

                <td colspan="2" class="text-center">
                    <input type="submit" class="btn-submit btn btn-primary" name="themloaisp" value="Thêm loại sản phẩm">
                </td>
            </tr>
        </table>
    </form>

</div>
<?php
function check_Loaisp($maloaisp)
{
    $sql = "SELECT * FROM LOAISANPHAM WHERE MALOAISANPHAM ='$maloaisp';";
    $res = Check_db($sql);
    if (mysqli_num_rows($res) > 0) {
        return true;
    } else {
        return false;
    }
}
if (isset($_POST['themloaisp'])) {
    $maloaisp = Get_value($_POST["maloaisp"]);
    $tenloaisp = Get_value($_POST["tenloaisp"]);

    if (!check_Loaisp($maloaisp)) {
        $conn = Connect();
        $sql = "INSERT INTO `LOAISANPHAM` (`MALOAISANPHAM`, `TENLOAISANPHAM`) VALUES ('$maloaisp', '$tenloaisp');";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        echo "<script>alert(\"Thêm loại sản phẩm thành công\");</script>";
        echo "<script>window.open('index.php?action=xemloaisanpham','_self')</script>";
    } else {
        echo "<script>alert(\"Loại sản phẩm đã tồn tại\");</script>";
    }
}

?>