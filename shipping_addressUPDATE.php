<?php

header("Access-Control-Allow-Origin: header");
header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

$id_shipping_address = $_POST['id_shipping_address'];
$nama_pengirim = $_POST['nama_pengirim'];
$nohp = $_POST['nohp'];
$provinsi = $_POST['provinsi'];
$kota = $_POST['kota'];
$kecamatan = $_POST['kecamatan'];
$kelurahan = $_POST['kelurahan'];
$alamat_lengkap = $_POST['alamat_lengkap'];
$kode_pos = $_POST['kode_pos'];

$sql = "UPDATE shipping_address SET nama_pengirim = '$nama_pengirim', nohp = '$nohp', provinsi = '$provinsi', kota = '$kota', kecamatan = '$kecamatan', kelurahan = '$kelurahan', alamat_lengkap = '$alamat_lengkap', kode_pos = '$kode_pos' WHERE id_shipping_address=$id_shipping_address";
$isSuccess = $koneksi->query($sql);


$res = [];
if ($isSuccess) {
    $cek = "SELECT * FROM shipping_address WHERE id_shipping_address = $id_shipping_address";
    $result = mysqli_fetch_assoc(mysqli_query($koneksi, $cek));

    $res['is_success'] = true;
    $res['value'] = 1;
    $res['message'] = "Berhasil edit data keranjang";
    $res['nama_pengirim'] = $result['nama_pengirim'];
    $res['nohp'] = $result['nohp'];
    $res['provinsi'] = $result['provinsi'];
    $res['kota'] = $result['kota'];
    $res['kecamatan'] = $result['kecamatan'];
    $res['kelurahan'] = $result['kelurahan'];
    $res['alamat_lengkap'] = $result['alamat_lengkap'];
    $res['kode_pos'] = $result['kode_pos'];
    $res['id_shipping_address'] = $result['id_shipping_address'];
} else {
    $res['is_success'] = false;
    $res['value'] = 0;
    $res['message'] = "Gagal edit data pegawai";
}

echo json_encode($res);

?>
