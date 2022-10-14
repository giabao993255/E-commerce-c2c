<?php
require_once('./includes/include.php');
require_once('./includes/conn.php');
if ($_SESSION['maquyen'] != "QTV") {
    echo "<script>window.open('../login.php','_self')</script>";
} else {
    $taikhoan = $_SESSION['taikhoan'];
}
?>
<!DOCTYPE html>
<html>

<?php include('./includes/head.php') ?>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./index.php">
                <div class="sidebar-brand-icon">
                    <img src="./../ClickBuy-noText.svg" alt="" style="width:110%">
                </div>
                <div class="sidebar-brand-text mx-3">ClickBuy</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Bảng điều khiển</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Danh sách
            </div>

            <!-- Nav Item - Product Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Sản phẩm</span>
                </a>
                <div id="collapseProduct" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemsanpham">Xem danh sách</a>
                        <a class="collapse-item" href="index.php?action=themsanpham">Thêm sản phẩm</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Type Of Product Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTypeOfProduct" aria-expanded="true" aria-controls="collapseTypeOfProduct">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Loại sản phẩm</span>
                </a>
                <div id="collapseTypeOfProduct" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemloaisanpham">Xem danh sách</a>
                        <a class="collapse-item" href="index.php?action=themloaisanpham">Thêm loại sản phẩm</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Producer Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducer" aria-expanded="true" aria-controls="collapseProducer">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Nhà sản xuất</span>
                </a>
                <div id="collapseProducer" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemnhasanxuat">Xem danh sách</a>
                        <a class="collapse-item" href="index.php?action=themnhasanxuat">Thêm nhà sản xuất</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Ware House Collapse Menu -->
            <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWareHouse" aria-expanded="true" aria-controls="collapseWareHouse">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kho</span>
            </a>
            <div id="collapseWareHouse" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Các chức năng:</h6>
                    <a class="collapse-item" href="#">Danh sách bán chạy</a>
                    <a class="collapse-item" href="#">Sản phẩm sắp hết</a>
                </div>
            </div>
        </li> -->

            <!-- Nav Item - Discount Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDiscout" aria-expanded="true" aria-controls="collapseDiscout">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Mã giảm giá</span>
                </a>
                <div id="collapseDiscout" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemmagiamgia">Xem danh sách</a>
                        <a class="collapse-item" href="index.php?action=themmagiamgia">Thêm mã giảm giá</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Order Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrder" aria-expanded="true" aria-controls="collapseOrder">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Đơn đặt hàng</span>
                </a>
                <div id="collapseOrder" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemxuathang">Xem danh sách</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Goods receipt Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReceipt" aria-expanded="true" aria-controls="collapseReceipt">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Đơn nhập hàng</span>
                </a>
                <div id="collapseReceipt" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemnhaphang">Xem danh sách</a>
                        <a class="collapse-item" href="index.php?action=themnhaphang">Thêm đơn nhập hàng</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Customer Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Khách hàng</span>
                </a>
                <div id="collapseCustomer" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemkhachhang">Xem danh sách</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Employee Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Nhân viên</span>
                </a>
                <div id="collapseEmployee" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Các chức năng:</h6>
                        <a class="collapse-item" href="index.php?action=xemnhanvien">Xem danh sách</a>
                        <a class="collapse-item" href="index.php?action=themnhanvien">Thêm nhân viên</a>
                    </div>
                </div>
            </li>

        </ul>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Xin chào <?php echo $taikhoan ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Thông tin tài khoản
                                </a>
                                <a class="dropdown-item" href="./../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">
                    <div class="view_product_box">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Danh sách nhân viên</h1>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-download fa-sm text-white-50"></i>
                                Tải báo cáo
                            </a>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <table id="dataid" class="table table-striped table-bordered" width="100%">
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
                                <?php
                                // $sql_all_staff = "SELECT * FROM NGUOIDUNG WHERE MAQUYEN = 'NV'";
                                // $res_all_staff = Check_db($sql_all_staff);
                                // while ($row = mysqli_fetch_array($res_all_staff)) {
                                //     $taikhoan = $row['TAIKHOAN'];
                                //     $tennd = $row['HOTEN'];
                                //     $sdt = $row['SDT'];
                                //     $diachi = $row['DIACHI'];
                                //     $email = $row['EMAIL'];

                                $sql_all_staff = "SELECT * FROM NGUOIDUNG WHERE MAQUYEN = 'NV'";
                                $res_all_staff = Check_db($sql_all_staff);
                                while ($row = mysqli_fetch_array($res_all_staff)) {
                                ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><?php echo $row['TAIKHOAN'] ?></td>
                                            <td class="text-center"><?php echo $row['HOTEN'] ?></td>
                                            <td class="text-center"><?php echo $row['SDT'] ?></td>
                                            <td class="text-center"><?php echo $row['DIACHI'] ?></td>
                                            <td class="text-center"><?php echo $row['EMAIL'] ?></td>
                                            <td class="text-center">
                                                <form method="post">
                                                    <input class="btn btn-danger btn-sm" style="padding: 4px 15px 4px 15px;" type="submit" name="delete_staff" id="delete_staff" value="Xóa">
                                                    <input style="display: none" type="text" name="taikhoan" id="taikhoan" value="<?php echo $taikhoan; ?>">
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php
                                } // End while loop 
                                ?>
                            </table>
                        </form>
                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function() {
                    var datatablephp = $('#dataid').DataTable();
                });
            </script>

            <?php
            function Check_Staff($taikhoan)
            {
                if (isset($_POST['submit'])) {
                    $sql = "SELECT * FROM NGUOIDUNG WHERE taikhoan = '$taikhoan';";
                    $res = Check_db($sql);
                    if (mysqli_num_rows($res) > 0) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }

            if (isset($_POST['delete_staff'])) {
                $taikhoan = $_POST['taikhoan'];
                $sql_del_staff = "DELETE FROM NGUOIDUNG WHERE taikhoan = '$taikhoan';";
                echo $sql_del_staff;
                $res_del_staff = Check_db($sql_del_staff);
                if ($res_del_staff) {
                    echo "<script>alert('Tài khoản được xóa thành công!')</script>";
                    echo "<script>window.open('index.php?action=xemnhanvien','_self')</script>";
                } else {
                    echo "<script>alert('xóa tài khoản không thành công!')</script>";
                }
            }
            ?>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ClickBuy 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn muốn đăng xuất?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" href=".././login.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
   
    <!-- <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

    <!-- Custom scripts for all pages-->
    <!-- <script src="js/admin.min.js"></script> -->
</body>

</html>