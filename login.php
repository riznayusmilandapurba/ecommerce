<?php

header("Access-Control-Allow-Origin: *");
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $response['value'] = 1;
        $response['message'] = "Berhasil login";
        $response['fullname'] = $user['fullname'];
        $response['email'] = $user['email'];
        $response['phone'] = $user['phone'];
        $response['address'] = $user['address'];
        $response['id_user'] = $user['id_user'];

        // Memeriksa apakah pengguna adalah admin atau customer berdasarkan nilai role
        if ($user['role'] == '1') {
            $response['role'] = 'admin';
        } else if ($user['role'] == '2') {
            $response['role'] = 'customer';
        } else {
            $response['role'] = 'unknown';
        }

        echo json_encode($response);
    } else {
        $response['value'] = 0;
        $response['message'] = "Gagal login";
        echo json_encode($response);
    }

    $stmt->close();
}
?>
