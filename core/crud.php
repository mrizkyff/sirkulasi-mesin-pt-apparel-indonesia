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
    $result = mysqli_query($mysqli, "INSERT INTO tb_stok_mesin(nama_mesin, merk_mesin, harga, deskripsi) VALUES('$nama_mesin','$merk','$harga','$deskripsi')");

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


    // inputkan data ke tabel stok masuk
    $result = mysqli_query($mysqli, "INSERT INTO tb_log_masuk(id_mesin, jml_masuk, keterangan, created_at) VALUES('$id_mesin','$jml_masuk','$keterangan','$created_at')");
    if($result){
        $result = mysqli_query($mysqli, "UPDATE tb_stok_mesin SET stok='$update_stok'");
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
?>