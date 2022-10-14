<!DOCTYPE html>
<html>

<head>
    <title>Using Datatable In PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
    <style>
        .table-responsive {
            box-shadow: 0px 0px 5px #999;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <br />
                <h1>Using DataTable In PHP</h1><br />
                <div class="table-responsive">
                    <table id="dataid" class="table table-striped table-bordered" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Vietnamese</th>
                                <th>English</th>
                                <th>Create Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //connect to mysql
                            $conn = mysqli_connect("localhost", "root", "", "lvtn2") or die("Connect fail!");
                            mysqli_query($conn, "SET NAMES 'utf8'");
                            //fetch data from mysql
                            $sql = "SELECT * FROM NGUOIDUNG WHERE MAQUYEN = 'NV'";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['HOTEN'] ?></td>
                                    <td><?php echo $row['TAIKHOAN'] ?></td>
                                    <td><?php echo $row['SDT'] ?></td>
                                    <td><?php echo $row['EMAIL'] ?></td>
                                </tr>
                            <?php
                            } //end while
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        var datatablephp = $('#dataid').DataTable();
    });
</script>