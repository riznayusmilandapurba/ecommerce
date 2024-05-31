<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

$id_myfavorite = $_POST['id_myfavorite'];

$sql = "DELETE FROM myfavorite WHERE id_myfavorite= $id_myfavorite";
$isSuccess = $koneksi->query($sql);

$res = [];
if ($isSuccess) {
    $res['is_success'] = true;
    $res['value'] = 1;
    $res['message'] = "Berhasil menghapus data user dengan ID $id_myfavorite";
} else {
    $res['is_success'] = false;
    $res['value'] = 0;
    $res['message'] = "Gagal menghapus data user dengan ID $id_myfavorite";
}

echo json_encode($res);

?>
