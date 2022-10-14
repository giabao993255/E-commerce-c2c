<?php
include_once('./includes/include.php');
// if ($_SESSION['maquyen'] != "QTV" || $_SESSION['maquyen'] != "NV") {
//     echo "<script>window.open('../login.php','_self')</script>";
// } else {
$taikhoan = $_SESSION['taikhoan'];
// }
?>

<!DOCTYPE html>
<html>

<?php include('./includes/head.php') ?>


<body id="page-top">
    <div id="wrapper">
        <?php include('./includes/nav.php') ?>
        <div class="container-fluid">
            <div class="main">
                <div class="page-wrapper">
                    <?php
                    if (isset($_GET['action'])) {
                        $action = $_GET['action'];
                    } else {
                        $action = '';
                        echo '
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">Bảng điều khiển</h1>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 mb-6">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                                Thu nhập (Tháng)</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';
                        $sql_t4 = "SELECT * FROM HOADONXUAT 
                                                            WHERE NGAYXUAT BETWEEN '2022-05-01 00:00:00' AND '2022-05-31 23:59:59'";
                        $res_t4 = Check_db($sql_t4);
                        $kqt4 = 0;
                        while ($row_t4 = mysqli_fetch_assoc($res_t4)) {
                            $kqt4 = $kqt4 + $row_t4['SOLUONGSANPHAM'] * $row_t4['GIATIEN'];
                        }
                        echo number_format($kqt4, 0, '', ','), ' VND</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 mb-6">
                                            <div class="card border-left-success shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                Thu nhập (Năm)</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800">';
                        $sql_n = "SELECT * FROM HOADONXUAT 
                                                            WHERE NGAYXUAT BETWEEN '2022-01-01 00:00:00' AND '2022-12-31 23:59:59'";
                        $res_n = Check_db($sql_n);
                        $kqn = 0;
                        while ($row_n = mysqli_fetch_assoc($res_n)) {
                            $kqn = $kqn + $row_n['SOLUONGSANPHAM'] * $row_n['GIATIEN'];
                        }
                        echo number_format($kqn, 0, '', ','), 'VND</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="card shadow mb-2">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Thống kê doanh thu</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart-bar">
                                                    <canvas id="myBarChart" style="width: 500px; height: 140px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                    }
                    switch ($action) {
                        case 'themsanpham';
                            include './includes/themsanpham.php';
                            break;
                        case 'xemsanpham';
                            include './includes/xemsanpham.php';
                            break;
                        case 'chitietsanpham';
                            include './includes/chitietsanpham.php';
                            break;
                        case 'themloaisanpham';
                            include './includes/themloaisanpham.php';
                            break;
                        case 'xemloaisanpham';
                            include './includes/xemloaisanpham.php';
                            break;
                        case 'capnhatloaisanpham';
                            include './includes/capnhatloaisanpham.php';
                            break;
                        case 'xemnhanvien';
                            include './includes/xemnhanvien.php';
                            break;
                        case 'xemkhachhang';
                            include './includes/xemkhachhang.php';
                            break;
                        case 'themnhanvien';
                            include './includes/themnhanvien.php';
                            break;
                        case 'xoanhanvien';
                            include './includes/xoanhanvien.php';
                            break;
                        case 'xemmagiamgia';
                            include './includes/xemmagiamgia.php';
                            break;
                        case 'themmagiamgia';
                            include './includes/themmagiamgia.php';
                            break;
                        case 'capnhatmagiamgia';
                            include './includes/capnhatmagiamgia.php';
                            break;
                        case 'xemnhasanxuat';
                            include './includes/xemnhasanxuat.php';
                            break;
                        case 'themnhasanxuat';
                            include './includes/themnhasanxuat.php';
                            break;
                        case 'xoanhasanxuat';
                            include './includes/xoanhasanxuat.php';
                            break;
                        case 'xemgiohang';
                            include './includes/xemgiohang.php';
                            break;
                        case 'xemlichsumuahang';
                            include './includes/xemlichsumuahang.php';
                            break;
                        case 'capnhatnhasanxuat';
                            include './includes/capnhatnhasanxuat.php';
                            break;
                        case 'kiemtraxuathang';
                            include './includes/kiemtraxuathang.php';
                            break;
                        case 'xemxuathang';
                            include './includes/xemxuathang.php';
                            break;
                        case 'lichsuxuathang';
                            include './includes/lichsuxuathang.php';
                            break;
                        case 'xemnhaphang';
                            include './includes/xemnhaphang.php';
                            break;
                        case 'chitietnhaphang';
                            include './includes/chitietnhaphang.php';
                            break;
                        case 'themnhaphang';
                            include './includes/themnhaphang.php';
                            break;
                        case 'chitietdonhang';
                            include './includes/chitietdonhang.php';
                            break;
                        case 'indanhsachsanpham';
                            include './includes/indanhsachsanpham.php';
                            break;
                        case 'doimatkhau';
                            include './includes/doimatkhau.php';
                            break;
                        case 'xemdanhgia';
                            include './includes/xemdanhgia.php';
                            break;
                        case 'capnhatttdh';
                            include './includes/capnhatttdh.php';
                            break;
                        case 'chitietdanhgia';
                            include './includes/chitietdanhgia.php';
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('./includes/footer.php') ?>
    <?php
    $sql_t1 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-01-01 00:00:00' AND '2022-01-31 23:59:59'";
    $res_t1 = Check_db($sql_t1);
    $kqt1 = 0;
    while ($row_t1 = mysqli_fetch_assoc($res_t1)) {
        $kqt1 = $kqt1 + $row_t1['SOLUONGSANPHAM'] * $row_t1['GIATIEN'];
    }

    $sql_t2 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-02-01 00:00:00' AND '2022-02-31 23:59:59'";
    $res_t2 = Check_db($sql_t2);
    $kqt2 = 0;
    while ($row_t2 = mysqli_fetch_assoc($res_t2)) {
        $kqt2 = $kqt2 + $row_t2['SOLUONGSANPHAM'] * $row_t2['GIATIEN'];
    }

    $sql_t3 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-03-01 00:00:00' AND '2022-03-31 23:59:59'";
    $res_t3 = Check_db($sql_t3);
    $kqt3 = 0;
    while ($row_t3 = mysqli_fetch_assoc($res_t3)) {
        $kqt3 = $kqt3 + $row_t3['SOLUONGSANPHAM'] * $row_t3['GIATIEN'];
    }

    $sql_t4 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-04-01 00:00:00' AND '2022-04-31 23:59:59'";
    $res_t4 = Check_db($sql_t4);
    $kqt4 = 0;
    while ($row_t4 = mysqli_fetch_assoc($res_t4)) {
        $kqt4 = $kqt4 + $row_t4['SOLUONGSANPHAM'] * $row_t4['GIATIEN'];
    }

    $sql_t5 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-05-01 00:00:00' AND '2022-05-31 23:59:59'";
    $res_t5 = Check_db($sql_t5);
    $kqt5 = 0;
    while ($row_t5 = mysqli_fetch_assoc($res_t5)) {
        $kqt5 = $kqt5 + $row_t5['SOLUONGSANPHAM'] * $row_t5['GIATIEN'];
    }

    $sql_t6 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-06-01 00:00:00' AND '2022-06-31 23:59:59'";
    $res_t6 = Check_db($sql_t6);
    $kqt6 = 0;
    while ($row_t6 = mysqli_fetch_assoc($res_t6)) {
        $kqt6 = $kqt6 + $row_t6['SOLUONGSANPHAM'] * $row_t6['GIATIEN'];
    }

    $sql_t7 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-07-01 00:00:00' AND '2022-07-31 23:59:59'";
    $res_t7 = Check_db($sql_t7);
    $kqt7 = 0;
    while ($row_t7 = mysqli_fetch_assoc($res_t7)) {
        $kqt7 = $kqt6 + $row_t7['SOLUONGSANPHAM'] * $row_t7['GIATIEN'];
    }

    $sql_t8 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-08-01 00:00:00' AND '2022-08-31 23:59:59'";
    $res_t8 = Check_db($sql_t8);
    $kqt8 = 0;
    while ($row_t8 = mysqli_fetch_assoc($res_t8)) {
        $kqt8 = $kqt8 + $row_t8['SOLUONGSANPHAM'] * $row_t8['GIATIEN'];
    }

    $sql_t9 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-09-01 00:00:00' AND '2022-09-31 23:59:59'";
    $res_t9 = Check_db($sql_t9);
    $kqt9 = 0;
    while ($row_t9 = mysqli_fetch_assoc($res_t9)) {
        $kqt9 = $kqt9 + $row_t9['SOLUONGSANPHAM'] * $row_t9['GIATIEN'];
    }

    $sql_t10 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-10-01 00:00:00' AND '2022-10-31 23:59:59'";
    $res_t10 = Check_db($sql_t10);
    $kqt10 = 0;
    while ($row_t10 = mysqli_fetch_assoc($res_t10)) {
        $kqt10 = $kqt10 + $row_t10['SOLUONGSANPHAM'] * $row_t10['GIATIEN'];
    }

    $sql_t11 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-11-01 00:00:00' AND '2022-11-31 23:59:59'";
    $res_t11 = Check_db($sql_t11);
    $kqt11 = 0;
    while ($row_t11 = mysqli_fetch_assoc($res_t11)) {
        $kqt11 = $kqt11 + $row_t11['SOLUONGSANPHAM'] * $row_t11['GIATIEN'];
    }

    $sql_t12 = "SELECT * FROM HOADONXUAT 
                        WHERE NGAYXUAT BETWEEN '2022-12-01 00:00:00' AND '2022-12-31 23:59:59'";
    $res_t12 = Check_db($sql_t12);
    $kqt12 = 0;
    while ($row_t12 = mysqli_fetch_assoc($res_t12)) {
        $kqt12 = $kqt12 + $row_t12['SOLUONGSANPHAM'] * $row_t12['GIATIEN'];
    }
    ?>
    <script src="./vendor/chart.js/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                datasets: [{
                    label: "Doanh thu",
                    backgroundColor: "#4e73df",
                    hoverBackgroundColor: "#2e59d9",
                    borderColor: "#4e73df",
                    data: [<?php echo $kqt1 ?>, <?php echo $kqt2 ?>, <?php echo $kqt3 ?>, <?php echo $kqt4 ?>, <?php echo $kqt5 ?>, <?php echo $kqt6 ?>, <?php echo $kqt7 ?>, <?php echo $kqt8 ?>, <?php echo $kqt9 ?>, <?php echo $kqt10 ?>, <?php echo $kqt11 ?>, <?php echo $kqt12 ?>],
                }],
            },
        });
    </script>
</body>

</html>