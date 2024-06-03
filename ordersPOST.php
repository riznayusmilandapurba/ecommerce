<?php
include 'koneksi.php';

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];


    mysqli_begin_transaction($koneksi);

    try {
      
        $query = "SELECT * FROM charts WHERE id_user = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "i", $id_user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $total_amount = 0;
            $order_details = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $id_product = $row['id_product'];
                $quantity = $row['quantity'];

                // Get product price (assumed to be fetched from a products table)
                $product_query = "SELECT price FROM products WHERE id_product = ?";
                $product_stmt = mysqli_prepare($koneksi, $product_query);
                mysqli_stmt_bind_param($product_stmt, "i", $id_product);
                mysqli_stmt_execute($product_stmt);
                $product_result = mysqli_stmt_get_result($product_stmt);
                $product = mysqli_fetch_assoc($product_result);
                $price = $product['price'];

                $total_amount += $price * $quantity;

                $order_details[] = array(
                    'id_product' => $id_product,
                    'quantity' => $quantity,
                    'price' => $price
                );
            }

            // Insert into orders
            $order_query = "INSERT INTO orders (id_user, total_amount, status) VALUES (?, ?, 'Pending')";
            $order_stmt = mysqli_prepare($koneksi, $order_query);
            mysqli_stmt_bind_param($order_stmt, "id", $id_user, $total_amount);
            mysqli_stmt_execute($order_stmt);
            $id_order = mysqli_insert_id($koneksi);

            // Insert into order_details
            foreach ($order_details as $detail) {
                $detail_query = "INSERT INTO order_details (id_order, id_product, quantity, price) VALUES (?, ?, ?, ?)";
                $detail_stmt = mysqli_prepare($koneksi, $detail_query);
                mysqli_stmt_bind_param($detail_stmt, "iiid", $id_order, $detail['id_product'], $detail['quantity'], $detail['price']);
                mysqli_stmt_execute($detail_stmt);
            }

            // Delete from charts
            $delete_query = "DELETE FROM charts WHERE id_user = ?";
            $delete_stmt = mysqli_prepare($koneksi, $delete_query);
            mysqli_stmt_bind_param($delete_stmt, "i", $id_user);
            mysqli_stmt_execute($delete_stmt);

            // Commit the transaction
            mysqli_commit($koneksi);

            $response['value'] = 1;
            $response['message'] = "Order successfully created";
        } else {
            $response['value'] = 0;
            $response['message'] = "No products in chart";
        }
    } catch (Exception $e) {
        // Rollback the transaction if something failed
        mysqli_rollback($koneksi);

        $response['value'] = 0;
        $response['message'] = "Error: " . $e->getMessage();
    }

    echo json_encode($response);
} else {
    $response['value'] = 0;
    $response['message'] = "Invalid request";
    echo json_encode($response);
}

?>
