<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $response = array();

    $id_user = $_POST['id_user'];
    $delivery_address = $_POST['delivery_address'];
    $status = $_POST['status'];

    // Query untuk mengambil total_amount dari tabel cart
    $sql_cart = "SELECT p.price, c.quantity 
                 FROM chart c
                 JOIN products p ON c.id_product = p.id_product
                 WHERE c.user_id = ?";
    
    // Persiapkan statement
    $stmt_cart = mysqli_prepare($koneksi, $sql_cart);

    if (!$stmt_cart) {
        $response['value'] = 0;
        $response['message'] = "Error: " . mysqli_error($koneksi);
        echo json_encode($response);
        exit;
    }
    
    // Bind parameter
    mysqli_stmt_bind_param($stmt_cart, "i", $id_user);
    
    // Eksekusi statement
    $result_execute = mysqli_stmt_execute($stmt_cart);

    if (!$result_execute) {
        $response['value'] = 0;
        $response['message'] = "Error: " . mysqli_error($koneksi);
        echo json_encode($response);
        exit;
    }
    
    // Ambil hasil query
    $result_cart = mysqli_stmt_get_result($stmt_cart);

    if (!$result_cart) {
        $response['value'] = 0;
        $response['message'] = "Error: " . mysqli_error($koneksi);
        echo json_encode($response);
        exit;
    }
    
    // Hitung total_amount
    $total_amount = 0;

    while ($row_cart = mysqli_fetch_assoc($result_cart)) {
        $price = $row_cart['price'];
        $quantity = $row_cart['quantity'];
        
        // Hitung total_amount untuk produk ini dan tambahkan ke total_amount
        $total_amount += $price * $quantity;
    }

    // Insert data ke dalam tabel orders menggunakan prepared statement
    $sql_insert = "INSERT INTO orders (id_user, delivery_address, total_amount, status) 
                   VALUES (?, ?, ?, ?)";
    
    // Persiapkan statement
    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
    
    if (!$stmt_insert) {
        $response['value'] = 0;
        $response['message'] = "Error: " . mysqli_error($koneksi);
        echo json_encode($response);
        exit;
    }
    
    // Bind parameter
    mysqli_stmt_bind_param($stmt_insert, "isds", $id_user, $delivery_address, $total_amount, $status);
    
    // Eksekusi statement
    $result_insert = mysqli_stmt_execute($stmt_insert);

    if ($result_insert) {
        $response['value'] = 1;
        $response['message'] = "Berhasil Tambah Data";
    } else {
        $response['value'] = 0;
        $response['message'] = "Tambah Data: " . mysqli_error($koneksi);
    }

    // Tutup statement
    mysqli_stmt_close($stmt_cart);
    mysqli_stmt_close($stmt_insert);
} else {
    $response['value'] = 0;
    $response['message'] = "Metode permintaan tidak valid";
}

echo json_encode($response);

?>
