<?php
include_once("config.php");

// tambah log masuk mesin baru
if(isset($_POST['submit_masuk'])){
    $nama_mesin = $_POST['nama_mesin'];
    $merk = $_POST['merk'];
    $jml_masuk = $_POST['jml_masuk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $keterangan = $_POST['keterangan'];
    $created_at = date("Y/m/d");

    // input ke tabel mesin dulu
    $result = mysqli_query($mysqli, "INSERT INTO tb_stok_mesin(nama_mesin, merk_mesin, stok,harga, deskripsi, created_at) VALUES('$nama_mesin','$merk', '$jml_masuk','$harga','$deskripsi','$created_at')");

    if ($result) {
        $last_id = $mysqli->insert_id;
        // inputkan data ke tabel stok masuk
        $result = mysqli_query($mysqli, "INSERT INTO tb_log_masuk(id_mesin, jml_masuk, keterangan, created_at) VALUES('$last_id','$jml_masuk','$keterangan','$created_at')");
        if($result){
            header("Location:../pages/log_masuk_mesin.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $mysqli->error;
        }
    } 
    else {
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
}

// input restok ke dalam log
if(isset($_POST['restock'])){
    $id_mesin = $_POST['id_mesin'];
    $jml_masuk = $_POST['jml_masuk'];
    $keterangan = $_POST['keterangan'];
    $created_at = date("Y/m/d");
    $stok_sekarang = $_POST['stok_sekarang'];
    $update_stok = $stok_sekarang+$jml_masuk;
    // print_r($_POST);
    // die();

    // inputkan data ke tabel stok masuk
    $result = mysqli_query($mysqli, "INSERT INTO tb_log_masuk(id_mesin, jml_masuk, keterangan, created_at) VALUES('$id_mesin','$jml_masuk','$keterangan','$created_at')");
    if($result){
        // update data ke tabel stok mesin
        $result = mysqli_query($mysqli, "UPDATE tb_stok_mesin SET stok='$update_stok' WHERE id='$id_mesin'");
        if($result){
            header("Location:../pages/log_masuk_mesin.php");
        }
        else{
            echo "Error: " . $result . "<br>" . $mysqli->error;
        }
    }
    else{
        echo "Error: " . $result . "<br>" . $mysqli->error;
    }
}

// update data mesin
if(isset($_POST['update_mesin'])){
    $id = $_POST['id'];
    $nama_mesin = $_POST['nama_mesin'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    
    // update data ke tabel stok mesin
    $result = mysqli_query($mysqli, "UPDATE tb_stok_mesin SET nama_mesin='$nama_mesin', merk_mesin='$merk', harga='$harga', deskripsi='$deskripsi' WHERE id='$id'");
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
?>