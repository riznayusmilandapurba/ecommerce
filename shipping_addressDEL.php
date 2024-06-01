<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

$id_shipping_address = $_POST['id_shipping_address'];

$sql = "DELETE FROM shipping_address WHERE id_shipping_address= $id_shipping_address";
$isSuccess = $koneksi->query($sql);

$res = [];
if ($isSuccess) {
    $res['is_success'] = true;
    $res['value'] = 1;
    $res['message'] = "Berhasil menghapus data user dengan ID $id_shipping_address";
} else {
    $res['is_success'] = false;
    $res['value'] = 0;
    $res['message'] = "Gagal menghapus data user dengan ID $id_shipping_address";
}

echo json_encode($res);

?>
