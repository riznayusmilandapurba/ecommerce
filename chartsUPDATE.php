<?php

header("Access-Control-Allow-Origin: header");
header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

$id_chart = $_POST['id_chart'];
$id_product = $_POST['id_product'];
$quantity = $_POST['quantity'];

$sql = "UPDATE charts SET id_product = '$id_product', quantity = '$quantity' WHERE id_chart=$id_chart";
$isSuccess = $koneksi->query($sql);


$res = [];
if ($isSuccess) {
    $cek = "SELECT * FROM charts WHERE id_chart = $id_chart";
    $result = mysqli_fetch_assoc(mysqli_query($koneksi, $cek));

    $res['is_success'] = true;
    $res['value'] = 1;
    $res['message'] = "Berhasil edit data keranjang";
    $res['id_product'] = $result['id_product'];
    $res['quantity'] = $result['quantity'];
    $res['id_chart'] = $result['id_chart'];
} else {
    $res['is_success'] = false;
    $res['value'] = 0;
    $res['message'] = "Gagal edit data pegawai";
}

echo json_encode($res);

?>
