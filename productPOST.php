<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $id_category = $_POST['id_category'];
    $foto = "";

    if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != '') {
        $file_name = $_FILES['foto']['name'];
        $file_size = $_FILES['foto']['size'];
        $file_tmp = $_FILES['foto']['tmp_name'];
        $file_type = $_FILES['foto']['type'];

        $extensions = array("jpeg", "jpg", "png");
        $file_ext = strtolower(end(explode('.', $_FILES['foto']['name'])));

        if (in_array($file_ext, $extensions) === false) {
            $response['value'] = 0;
            $response['message'] = "Extensi file tidak diperbolehkan, gunakan file JPEG atau PNG.";
            echo json_encode($response);
            exit();
        }

        $upload_path = "C:/xampp/htdocs/ecommerce/uploads/" . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $foto = $file_name;
        } else {
            $response['value'] = 0;
            $response['message'] = "Gagal mengunggah file gambar.";
            echo json_encode($response);
            exit();
        }
    }

    // Debugging
    if (empty($foto)) {
        $response['value'] = 0;
        $response['message'] = "File foto tidak ada atau gagal diunggah.";
        echo json_encode($response);
        exit();
    }

    $insert = "INSERT INTO products (name, description, price, stock, id_category, foto) 
               VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($insert);

    if ($stmt) {
        $stmt->bind_param("ssdiis", $name, $description, $price, $stock, $id_category, $foto);

        if ($stmt->execute()) {
            $response['value'] = 1;
            $response['message'] = "Berhasil Tambah Data";
        } else {
            $response['value'] = 0;
            $response['message'] = "Tambah Data: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['value'] = 0;
        $response['message'] = "Prepare statement gagal: " . $koneksi->error;
    }
} else {
    $response['value'] = 0;
    $response['message'] = "Metode permintaan tidak valid";
}

echo json_encode($response);

?>
