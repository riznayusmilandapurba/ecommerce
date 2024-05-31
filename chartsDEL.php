<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

$id_chart = $_POST['id_chart'];

$sql = "DELETE FROM charts WHERE id_chart= $id_chart";
$isSuccess = $koneksi->query($sql);

$res = [];
if ($isSuccess) {
    $res['is_success'] = true;
    $res['value'] = 1;
    $res['message'] = "Berhasil menghapus data user dengan ID $id_chart";
} else {
    $res['is_success'] = false;
    $res['value'] = 0;
    $res['message'] = "Gagal menghapus data user dengan ID $id_chart";
}

echo json_encode($res);

?>
