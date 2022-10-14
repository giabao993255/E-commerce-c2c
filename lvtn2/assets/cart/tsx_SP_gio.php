<?php

function test($sql)
{
    // include('connectDB.php');
    // $request = $conn->query($sql);
    // if (mysqli_num_rows($request) > 0) {
    //     $row = $request->fetch_assoc();
    //     return $row;
    // } else return null;
    // $conn->close();
}

function update($sql_update)
{
    include('connectDB.php');
    if ($conn->query($sql_update) != true) {
        echo "error: " . $sql_update . "<br>" . $conn->error;
    }
    $conn->close();
}
function themSP_gio($MASP)
{
    $TAIKHOAN = $_SESSION['taikhoan'];
    $row_SPGH = test("SELECT * FROM GIOHANG, SANPHAM WHERE GIOHANG.MASANPHAM=SANPHAM.MASANPHAM and TAIKHOAN='$TAIKHOAN' AND GIOHANG.MASANPHAM='$MASP'");
    if ($row_SPGH != null) {
        $SOLUONGSANPHAM = $row_SPGH['SOLUONGSANPHAM'] + 1;
        update("UPDATE giohang SET SOLUONGSANPHAM='$SOLUONGSANPHAM' WHERE TAIKHOAN='$TAIKHOAN' AND MASANPHAM='$MASP'");
    } else {
        include('connectDB.php');
        $sql = "INSERT INTO giohang VALUES('1','$TAIKHOAN' , '$MASP')";
        if ($conn->query($sql) != true) {
            echo "error: " . $sql . "<br>" . $conn->error;
        } else echo "<script>
            
            </script>";
        $conn->close();
    }
}

function sua_SP_gio($SOLUONGGIO)
{
    include('connectDB.php');
    $TAIKHOAN = $_SESSION['taikhoan'];
    $row_SPGH = test("SELECT*FROM sanphamgiohang WHERE TAIKHOAN='$TAIKHOAN' AND MASP='$MASP'");
    if ($row_SPGH != null) {
        update("UPDATE sanphamgiohang SET SOLUONGGIO='$SOLUONGGIO' WHERE TAIKHOAN='$TAIKHOAN' AND MASP='$MASP");
    }
    $conn->close();
}

function xoa_SP_gio($MASP)
{
    include('connectDB.php');
    $sql = "DELETE FROM sanphamgiohang WHERE MASP='$MASP'";
    if ($conn->query($sql) == true) {
        header('Location: ./cart.php');
    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function view_sp_gio($TAIKHOAN)
{
    include('connectDB.php');
    $sql = "SELECT sanphamgiohang.MASP,LINK,sanpham.TENSP,sanpham.GIA,SOLUONGGIO FROM hinhanh,sanpham,sanphamgiohang WHERE sanpham.MASP=hinhanh.MASP AND sanphamgiohang.MASP=sanpham.MASP AND sanphamgiohang.TAIKHOAN='$TAIKHOAN'";
    if ($conn->query($sql) == true) {
        $request = mysqli_query($conn, $sql);
        if (mysqli_num_rows($request) > 0) {
            while ($row_SPGH = $request->fetch_assoc()) {
                $masp = $row_SPGH['MASP'];
                $hinh = $row_SPGH['LINK'];
                $tensp = $row_SPGH['TENSP'];
                $gia = $row_SPGH['GIA'];
                $soluonggio = $row_SPGH['SOLUONGGIO'];
                $tien = $gia * $soluonggio;
                echo "
                    <tr>
                    <td>
                        <a href='view.php?tenbien=$masp' class='cartItem__product'>
                            <img src='../admin/product_images/" . $hinh . "' alt=''>
                        </a>
                    </td>
                    <td>
                        <div class='cartItem__product--intro'>
                            <h4>Title</h4>
                            <p>" . $tensp . "</p>
                        </div>
                    </td>
                    <td>" . currency_format($gia, ' VND') . "</td>
                    <td>
                        <input type='number' name='' id='soluong' min='1' value='" . $soluonggio . "' oninput='sua_soluong($gia)'>
                    </td>
                    <td>
                        <p style='margin:0' id='tien'>" . currency_format($tien, ' VND') . "</p>
                    </td>
                    <td>
                        <a href='delete.php?mas=$masp'> <i class='fa fa-trash-alt'></i></a>
                    </td>
                </tr>
                <tr class='spacer'></tr>
                    ";
            }
        }
    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function currency_format($number, $suffix)
{
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . "$suffix";
    }
}
