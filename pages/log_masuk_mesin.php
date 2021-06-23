<?php
session_start();
if($_SESSION['status'] != 'login'){
    header("Location: ../index.php");
}
// panggil file config database
include_once("../core/config.php");
 
// Fetch all users data from database
$data_masuk = mysqli_query($mysqli, "SELECT masuk.id as id, stok.id as id_mesin, jml_masuk, keterangan, nama_mesin, merk_mesin, stok, harga, deskripsi, masuk.created_at as created_at FROM tb_log_masuk as masuk INNER JOIN tb_stok_mesin as stok ON masuk.id_mesin=stok.id");

// foreach ($data_masuk as $data) {
//     print_r($data);
// }
// die();
?>
 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Mekanik | Log Masuk Mesin</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SIM</div>
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kelola Mesin
            </div>

            <!-- Nav Item - Stock In -->
            <li class="nav-item active">
                <a class="nav-link" href="log_masuk_mesin.php">
                    <i class="fas fa-fw fa-cart-arrow-down"></i>
                    <span>Stock In</span></a>
            </li>

            <!-- Nav Item - Stock Mesin -->
            <li class="nav-item">
                <a class="nav-link" href="stok_mesin.php">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Stock Mesin</span></a>
            </li>

            <!-- Nav Item - Stock Out  -->
            <li class="nav-item">
                <a class="nav-link" href="log_keluar_mesin.php">
                    <i class="fas fa-fw fa-luggage-cart"></i>
                    <span>Stock Out</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrator
            </div>

            <!-- Nav Item - Stock Out  -->
            <li class="nav-item">
                <a data-toggle="modal" data-target="#logoutModal" class="nav-link" href="#">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>Log Out</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            

            
        </ul>
        <!-- End of Sidebar -->

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
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle"
                                    src="../img/undraw_profile.svg">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Log Masuk Mesin</h1>
                    <p class="mb-4">Tabel berikut ini merupakan tabel dari log masuk mesin yang telah diinputkan, untuk daftar mesin dapat dilihat pada halama berikut <a href="stok_mesin.php">Stock Mesin</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Stock In/Log Masuk Mesin</h6>
                            <a data-toggle="modal" data-target="#modalTambah" href="#" class="btn btn-success btn-icon-split btn-sm" style="float: right; margin-top: -25px;">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah Mesin Baru</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>
                                            <th>Nama Mesin</th>
                                            <th>Merek Mesin</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Log</th>
                                            <th width="175px">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Mesin</th>
                                            <th>Merek Mesin</th>
                                            <th>Jumlah Masuk</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Log</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                        $no = 0;
                                        foreach ($data_masuk as $data) {
                                        $no += 1;
                                    ?>
                                        <tr>
                                            <td><?= $data['id'] ?></td>
                                            <td><?= $data['nama_mesin'] ?></td>
                                            <td><?= $data['merk_mesin'] ?></td>
                                            <td><?= $data['jml_masuk'] ?></td>
                                            <td><?= $data['keterangan'] ?></td>
                                            <td><?= $data['created_at'] ?></td>
                                            <td>
                                                <a data-toggle="modal" data-target="#modalRestock<?= $data['id'] ?>" href="#" class="btn btn-primary btn-sm btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-retweet"></i>
                                                    </span>
                                                    <span class="text">Restock</span>
                                                </a>
                                                <a data-toggle="modal" data-target="#modalEdit<?= $data['id'] ?>" href="#" class="btn btn-info btn-sm btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </span>
                                                    <span class="text">Edit</span>
                                                </a>
                                                <!-- <a disabled href="#" class="btn disabled btn-danger btn-sm btn-icon-split">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Hapus</span>
                                                </a> -->

                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modalEdit<?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Log Masuk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="../core/crud.php">
                                                        <div class="form-group row">
                                                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                            <label for="nama_mesin" class="col-4 col-form-label">Nama Mesin</label> 
                                                            <div class="col-8">
                                                            <input id="nama_mesin" name="nama_mesin" type="text" class="form-control" value="<?= $data['nama_mesin'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jml_masuk" class="col-4 col-form-label">Jumlah Masuk</label> 
                                                            <div class="col-8">
                                                            <input id="jml_masuk" name="jml_masuk" type="text" class="form-control" value="<?= $data['jml_masuk'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="keterangan" class="col-4 col-form-label">Keterangan</label> 
                                                            <div class="col-8">
                                                            <textarea id="keterangan" name="keterangan" cols="40" rows="4" class="form-control"><?= $data['keterangan'] ?></textarea>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="edit_masuk" class="btn btn-info">Update <i class="fas fa-edit    "></i></button>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <!-- Modal Restock-->
                                                <div class="modal fade" id="modalRestock<?= $data['id'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Restock Mesin</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form method="POST" action="../core/crud.php">
                                                        <input type="hidden" name="id_mesin" value="<?= $data['id_mesin'] ?>">
                                                        <input type="hidden" name="stok_sekarang" value="<?= $data['stok'] ?>">
                                                        <div class="form-group row">
                                                            <label for="nama_mesin" class="col-4 col-form-label">Nama Mesin</label> 
                                                            <div class="col-8">
                                                            <input id="nama_mesin" name="nama_mesin" type="text" class="form-control" value="<?= $data['nama_mesin'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="merk" class="col-4 col-form-label">Merek Mesin</label> 
                                                            <div class="col-8">
                                                            <input id="merk" name="merk" placeholder="Merek Mesin" type="text" class="form-control" value="<?= $data['merk_mesin'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jml_masuk" class="col-4 col-form-label">Jumlah Masuk</label> 
                                                            <div class="col-8">
                                                            <input id="jml_masuk" name="jml_masuk" placeholder="Jumlah Restock Mesin Masuk" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="harga" class="col-4 col-form-label">Harga</label> 
                                                            <div class="col-8">
                                                            <input id="harga" name="harga" placeholder="Harga Mesin" type="text" class="form-control" value="<?= $data['harga'] ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="deskripsi" class="col-4 col-form-label">Deskripsi Mesin</label> 
                                                            <div class="col-8">
                                                            <textarea id="deskripsi" name="deskripsi" cols="40" rows="2" class="form-control" disabled><?= $data['deskripsi'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="keterangan" class="col-4 col-form-label">Keterangan</label> 
                                                            <div class="col-8">
                                                            <textarea id="keterangan" name="keterangan" cols="40" rows="4" class="form-control"></textarea>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" name="restock" class="btn btn-primary">Restock <i class="fas fa-paper-plane    "></i></button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
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
                        <span>Copyright &copy; SIM - Sistem Informasi Mekanik 2021</span>
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

    <!-- Modal Tambah-->
    <div class="modal fade" id="modalTambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Input Mesin Baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="../core/crud.php">
            <div class="form-group row">
                <label for="nama_mesin" class="col-4 col-form-label">Nama Mesin</label> 
                <div class="col-8">
                <input id="nama_mesin" name="nama_mesin" placeholder="Nama Mesin" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="merk" class="col-4 col-form-label">Merek Mesin</label> 
                <div class="col-8">
                <input id="merk" name="merk" placeholder="Merek Mesin" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="jml_masuk" class="col-4 col-form-label">Jumlah Masuk</label> 
                <div class="col-8">
                <input id="jml_masuk" name="jml_masuk" placeholder="Jumlah Mesin Masuk" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-4 col-form-label">Harga</label> 
                <div class="col-8">
                <input id="harga" name="harga" placeholder="Harga Mesin" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="deskripsi" class="col-4 col-form-label">Deskripsi Mesin</label> 
                <div class="col-8">
                <textarea id="deskripsi" name="deskripsi" cols="40" rows="2" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="keterangan" class="col-4 col-form-label">Keterangan</label> 
                <div class="col-8">
                <textarea id="keterangan" name="keterangan" cols="40" rows="4" class="form-control"></textarea>
                </div>
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" name="submit_masuk" class="btn btn-success">Simpan <i class="fas fa-save    "></i></button>
        </div>
        </form>
        </div>
    </div>
    </div>

    
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah ini untuk keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="../core/crud.php" method="POST">
                        <button name="logout" type="submit"class="btn btn-danger"><i class="fas fa-lock"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>