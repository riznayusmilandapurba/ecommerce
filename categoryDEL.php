<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

$id_category = $_POST['id_category'];

$sql = "DELETE FROM category WHERE id_category= $id_category";
$isSuccess = $koneksi->query($sql);

$res = [];
if ($isSuccess) {
    $res['is_success'] = true;
    $res['value'] = 1;
    $res['message'] = "Berhasil menghapus data user dengan ID $id_category";
} else {
    $res['is_success'] = false;
    $res['value'] = 0;
    $res['message'] = "Gagal menghapus data user dengan ID $id_category";
}

echo json_encode($res);

?>
