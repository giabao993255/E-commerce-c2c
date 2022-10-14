<?php
    require_once('./includes/include.php');
    require_once('./includes/conn.php');
    if(isset($_POST['update_discount'])){
        Check_f5($_POST['update_discount']);
    }
    $magiamgia = $_GET['discount_id'];
    $update_discount = Check_db("SELECT * from GIAMGIA where magiamgia ='$magiamgia';");
    $row = mysqli_fetch_array($update_discount);
    $tengiamgia = $row['TENGIAMGIA'];
    $phantram = $row['PHANTRAM'];
?>
<div class="form_box">
    <script>
        const Check_percent = function () {
            let percent = document.getElementById('phantram').value;
            if(!isNaN(percent)){
                document.getElementById('kiemtraphtram').innerHTML = '';
            } else {
                document.getElementById('kiemtraphtram').style.color = 'red';
                document.getElementById('kiemtraphtram').innerHTML = 'Phải là số';
            }
        }

        const Check_all = function() {
            let percent = document.getElementById('phantram').value;
            if(isNaN(percent)){
                alert("Phần trăm bắt buộc phải là số!");
                return false;
            }
        }
    </script>
    <h2>Sửa sản phẩm</h2>
    <div class="border_bottom"></div>
    <!--/.border_bottom -->
    <form method="post" onsubmit="return Check_all()" enctype="multipart/form-data">
        <table align="center" width="100%">
            <tr>
                <td><b>Mã giảm giá:</b></td>
                <td><input type="text" name="magiamgia" value="<?php echo $magiamgia;?>" size="60" disabled/></td>
            </tr>
            <tr>
                <td><b>Tên giảm giá: </b></td>
                <td><input type="text" name="tengiamgia" value="<?php echo $tengiamgia; ?>" required /></td>
            </tr>
            <tr>
                <td><b>Phần trăm: </b></td>
                <td>
                    <input type="text" name="phantram" id="phantram" value="<?php echo $phantram;?>" onkeyup="Check_percent()" required />
                    <span id="kiemtraphtram"></span>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-center"><input class="btn btn-primary btn-submit" type="submit"
                        name="update_discount" value="Lưu" /></td>
            </tr>
        </table>
    </form>
</div>

<?php 
    if(isset($_POST['update_discount'])){
        $tengiamgia = Get_value($_POST['tengiamgia']);
        $phantram = Get_value($_POST['phantram']);
        $sql_update_discount = "UPDATE GIAMGIA SET TENGIAMGIA = '$tengiamgia', PHANTRAM = $phantram WHERE `MAGIAMGIA` = '$magiamgia';";
        $res_update_discount = Check_db($sql_update_discount);
        if($res_update_discount){
            echo "<script>alert('Giảm giá đã được chỉnh sửa thành công!')</script>";
            echo "<script>window.open(window.location.href,'_self')</script>";
        }
        else{
            echo "<script>alert('Giảm giá đã được chỉnh sửa thất bại!')</script>";
        }
    }
?>