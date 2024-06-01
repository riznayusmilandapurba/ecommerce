<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$sql = "SELECT s.*, u.fullname as 'User'
        FROM shipping_address s
        JOIN users u ON s.id_user = u.id_user";

$result = $koneksi->query($sql);

$response = array();

if ($result) {
    if ($result->num_rows > 0) {
        $response['isSuccess'] = true;
        $response['message'] = "Berhasil Menampilkan Data Delivery";
        $response['data'] = array();
        while ($row = $result->fetch_assoc()) {
            $response['data'][] = $row;
        }
    } else {
        $response['isSuccess'] = false;
        $response['message'] = "Tidak Ada Data Delivery";
        $response['data'] = null;
    }
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Gagal Menampilkan Data Delivery: " . $koneksi->error;
    $response['data'] = null;
}

echo json_encode($response);

?>
