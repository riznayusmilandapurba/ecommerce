<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_user = $_GET['id_user'];

    try {
        // Query untuk mengambil data dari tabel orders berdasarkan id_user
        $order_query = "SELECT * FROM orders WHERE id_user = ?";
        $order_stmt = mysqli_prepare($koneksi, $order_query);
        mysqli_stmt_bind_param($order_stmt, "i", $id_user);
        mysqli_stmt_execute($order_stmt);
        $order_result = mysqli_stmt_get_result($order_stmt);

        if (mysqli_num_rows($order_result) > 0) {
            $response['isSuccess'] = true;
            $response['message'] = "Berhasil Menampilkan Data Order";
            $response['data'] = array();

            while ($order = mysqli_fetch_assoc($order_result)) {
                $id_order = $order['id_order'];
                
                // Query untuk mengambil data dari tabel order_details berdasarkan id_order
                $detail_query = "SELECT * FROM order_details WHERE id_order = ?";
                $detail_stmt = mysqli_prepare($koneksi, $detail_query);
                mysqli_stmt_bind_param($detail_stmt, "i", $id_order);
                mysqli_stmt_execute($detail_stmt);
                $detail_result = mysqli_stmt_get_result($detail_stmt);
                
                $order_details = array();
                while ($detail = mysqli_fetch_assoc($detail_result)) {
                    $order_details[] = $detail;
                }
                
                $order['details'] = $order_details;
                $response['data'][] = $order;
            }
        } else {
            $response['isSuccess'] = false;
            $response['message'] = "Tidak Ada Data Order";
            $response['data'] = null;
        }
    } catch (Exception $e) {
        $response['isSuccess'] = false;
        $response['message'] = "Gagal Menampilkan Data Order: " . $e->getMessage();
        $response['data'] = null;
    }

    echo json_encode($response);
} else {
    $response['isSuccess'] = false;
    $response['message'] = "Invalid request";
    echo json_encode($response);
}

?>
