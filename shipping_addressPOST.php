<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

$response = array();

$id_user = $_POST['id_user'];
$nama_pengirim = $_POST['nama_pengirim'];
$nohp = $_POST['nohp'];
$provinsi = $_POST['provinsi'];
$kota = $_POST['kota'];
$kecamatan = $_POST['kecamatan'];
$kelurahan = $_POST['kelurahan'];
$alamat_lengkap = $_POST['alamat_lengkap'];
$kode_pos = $_POST['kode_pos'];


$insert = "INSERT INTO shipping_address (id_user, nama_pengirim, nohp, provinsi, kota, kecamatan, kelurahan, alamat_lengkap, kode_pos) 
               VALUES ('$id_user', '$nama_pengirim', '$nohp', '$provinsi', '$kota', '$kecamatan', '$kelurahan', '$alamat_lengkap', '$kode_pos')";

    if (mysqli_query($koneksi, $insert)) {
        $response['value'] = 1;
        $response['message'] = "Berhasil Tambah Data";
    } else {
        $response['value'] = 0;
        $response['message'] = "Tambah Data: " . mysqli_error($koneksi);
    }
} else {
    $response['value'] = 0;
    $response['message'] = "Metode permintaan tidak valid";
}

echo json_encode($response);

?>
