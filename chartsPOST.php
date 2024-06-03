<?php

header("Access-Control-Allow-Origin: *");

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $response = array();

    $id_user = $_POST['id_user'];
    $id_product = $_POST['id_product'];
    $quantity = $_POST['quantity'];

    $check = "SELECT quantity FROM charts WHERE id_user='$id_user' AND id_product='$id_product'";
    $result = mysqli_query($koneksi, $check);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $new_quantity = $row['quantity'] + $quantity;

        if ($new_quantity > 0) {
            $update = "UPDATE charts SET quantity='$new_quantity' WHERE id_user='$id_user' AND id_product='$id_product'";
            if (mysqli_query($koneksi, $update)) {
                $response['value'] = 1;
                $response['message'] = "Berhasil Update Data";
            } else {
                $response['value'] = 0;
                $response['message'] = "Update Data: " . mysqli_error($koneksi);
            }
        } else {
            $delete = "DELETE FROM charts WHERE id_user='$id_user' AND id_product='$id_product'";
            if (mysqli_query($koneksi, $delete)) {
                $response['value'] = 1;
                $response['message'] = "Berhasil Hapus Data";
            } else {
                $response['value'] = 0;
                $response['message'] = "Hapus Data: " . mysqli_error($koneksi);
            }
        }
    } else {
        $insert = "INSERT INTO charts (id_user, id_product, quantity) 
                   VALUES ('$id_user', '$id_product', '$quantity')";
        if (mysqli_query($koneksi, $insert)) {
            $response['value'] = 1;
            $response['message'] = "Berhasil Tambah Data";
        } else {
            $response['value'] = 0;
            $response['message'] = "Tambah Data: " . mysqli_error($koneksi);
        }
    }
} else {
    $response['value'] = 0;
    $response['message'] = "Metode permintaan tidak valid";
}

echo json_encode($response);

?>
