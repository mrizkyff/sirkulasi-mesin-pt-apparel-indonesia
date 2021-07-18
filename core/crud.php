<?php
include_once("config.php");

// tambah mesin baru
if(isset($_POST['submit_baru'])){
    $nama_mesin = $_POST['nama_mesin'];
    $no_id_mesin = $_POST['no_id_mesin'];
    $status = $_POST['status'];
    $created_at = date("Y/m/d");
    $stock_status = "stock";
    // input ke tabel mesin dulu
    $result = mysqli_query($mysqli, "INSERT INTO tb_stok_mesin(nama_mesin, no_id_mesin, status, stock_status, created_at) VALUES('$nama_mesin','$no_id_mesin','$status','$stock_status','$created_at')");

    if ($result) {
        // $last_id = $mysqli->insert_id;
        // inputkan data ke tabel stok masuk
        // $result = mysqli_query($mysqli, "INSERT INTO tb_log_masuk(id_mesin, keterangan, created_at) VALUES('$last_id','$keterangan','$created_at')");
        // if($result){
        //     header("Location:../pages/log_masuk_mesin.php");
        // }
        // else{
        //     echo "Error: " . $result . "<br>" . $mysqli->error;
        // }
        header("Location:../pages/log_masuk_mesin.php");

    } 
    else {
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
}

// update data mesin
if(isset($_POST['update_mesin'])){
    $id = $_POST['id'];
    $nama_mesin = $_POST['nama_mesin'];
    $no_id_mesin = $_POST['no_id_mesin'];
    $status = $_POST['status'];
    
    // update data ke tabel stok mesin
    $result = mysqli_query($mysqli, "UPDATE tb_stok_mesin SET nama_mesin='$nama_mesin', no_id_mesin='$no_id_mesin', status='$status' WHERE id='$id'");
    if($result){
        header("Location:../pages/stok_mesin.php");
    }
    else{
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
    
}

// softdelete data mesin
if(isset($_POST['hapus_mesin'])){
    $id = $_POST['id'];
    $deleted_at = date("Y/m/d");

    // update data ke tabel stok mesin
    $result = mysqli_query($mysqli, "UPDATE tb_stok_mesin SET deleted_at='$deleted_at' WHERE id='$id'");
    if($result){
        header("Location:../pages/stok_mesin.php");
    }
    else{
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
    
}

// input data ke dalam log keluar
if(isset($_POST['submit_keluar'])){
    $id_mesin = $_POST['id_mesin'];
    $mekanik = $_POST['mekanik'];
    $keterangan = $_POST['keterangan'];
    $created_at = date("Y/m/d");
    $update_stok = 'keluar';
    // print_r($_POST);
    // die();

    // inputkan data ke tabel stok keluar
    $result = mysqli_query($mysqli, "INSERT INTO tb_log_keluar(id_mesin, mekanik, keterangan, created_at) VALUES('$id_mesin','$mekanik','$keterangan','$created_at')");
    if($result){
        // update stock_status menjadi keluar
        $result = mysqli_query($mysqli, "UPDATE tb_stok_mesin SET stock_status='$update_stok' WHERE id='$id_mesin'");
        if($result){
            header("Location:../pages/log_keluar.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $mysqli->error;
        }
    }
    else{
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
}





// stock out data mesin
if(isset($_POST['out_mesin'])){
    $id = $_POST['id_mesin'];
    $penerima = $_POST['penerima'];
    $jml_keluar = $_POST['jml_keluar'];
    $keterangan = $_POST['keterangan'];
    $created_at = date("Y/m/d");
    $stok_sekarang = $_POST['stok_sekarang'];
    $update_stok = $stok_sekarang-$jml_keluar;

    // inputkan data ke tabel stok keluar
    $result = mysqli_query($mysqli, "INSERT INTO tb_log_keluar(id_mesin, penerima, jml_keluar, keterangan,created_at) VALUES('$id','$penerima','$jml_keluar','$keterangan','$created_at')");
    if($result){
        // update data ke tabel stok mesin
        $result = mysqli_query($mysqli, "UPDATE tb_stok_mesin SET stok='$update_stok' WHERE id='$id'");
        if($result){
            header("Location:../pages/log_keluar_mesin.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $mysqli->error;
        }
    }
    else{
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
}

// edit stock in/masuk
if(isset($_POST['edit_masuk'])){
    $id = $_POST['id'];
    $keterangan = $_POST['keterangan'];

    // update keterangan
    $result = mysqli_query($mysqli, "UPDATE tb_log_masuk SET keterangan='$keterangan' WHERE id='$id'");
    if($result){
        header("Location:../pages/log_masuk_mesin.php");
    }
    else{
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
}

// edit stock out/keluar
if(isset($_POST['edit_keluar'])){
    $id = $_POST['id'];
    $mekanik = $_POST['mekanik'];
    $keterangan = $_POST['keterangan'];

    // update keterangan
    $result = mysqli_query($mysqli, "UPDATE tb_log_keluar SET mekanik='$mekanik', keterangan='$keterangan' WHERE id='$id'");
    if($result){
        header("Location:../pages/log_keluar_mesin.php");
    }
    else{
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
}

// untuk logout
if(isset($_POST['logout'])){
    session_start();
    $_SESSION['username'] = '';
    unset($_SESSION['username']);
    session_unset();
    session_destroy();
    header("Location: ../index.php");
}
?>