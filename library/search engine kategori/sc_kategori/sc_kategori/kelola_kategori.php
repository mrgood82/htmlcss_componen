<?php
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script type="text/javascript">
        function delete_kategori(id){
            if(confirm('Apakah Anda Yakin Ingin Menghapus Data Kategori Dengan id : '+id+'?'))
            {
            window.location.href='delete_kategori.php?id='+id;
            }
        }
    </script>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include('menu.php');?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kelola Kategori</h1>
                        <a href="add_kategori.php" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Add</a>
                    </div>
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Daftar Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="cari" class="form-control">
                                        <div class="input-group-prepend">
                                            <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div> 
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Kategori</th>
                                            <th>Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                        <?php
                                        $limit = 5;
                                        $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
                                        $page1 = ($page > 1) ? ($page * $limit) - $limit : 0;
                                        $back=$page-1;
                                        $next=$page+1;
                                        $data_page = mysql_query("select count(*) as jumlah from tbl_kategori");
                                        $jumlah_data = mysql_fetch_array($data_page);
                                        $jumlah_page = $jumlah_data['jumlah'];
                                        $count_page= ceil($jumlah_page / $limit);
                                        if((isset($_POST['search']))and ($_POST['cari'] <> "")){
                                            $cari=$_POST['cari'];
                                            $query = mysql_query("select * from tbl_kategori where kategori like '%$cari%'");
                                        }else{
                                            $query = mysql_query("select * from tbl_kategori limit $page1, $limit");
                                        }
                                        $no = 1;
                                        while($data = mysql_fetch_array($query)){
                                        ?>
                                        <tbody>
                                        <tr>
                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $data['kd_kategori']?></td>
                                            <td><?php echo $data['kategori']?></td>
                                            <td>
                                            <a href="update_kategori.php?id=<?php echo $data['id_kategori']?>" class="btn btn-warning"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>  
                                            <a href="javascript:delete_kategori(<?php echo $data['id_kategori']?>)" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>         
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item">
                                    <a <?php if($page > 1) { echo "href='?page=$back'";}?> class="page-link">Back</a>
                                    </li>
                                    <?php
                                    for($x=1;$x<=$count_page;$x++){
                                    ?>
                                    <li class="page-item">
                                    <a href="?page=<?php echo $x?>" class="page-link"><?php echo $x?></a>
                                    </li>
                                    <?php }?>
                                    <li class="page-item">
                                    <a <?php if($page < $count_page){ echo "href='?page=$next'";}?> class="page-link">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>