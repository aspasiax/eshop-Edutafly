<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $cart = $data['cart'] ?? [];
    $customer_name = $data['customer_name'] ?? '';
    $customer_email = $data['customer_email'] ?? '';
    $customer_address = $data['customer_address'] ?? '';

    $_SESSION['cart'] = $cart;

    require_once('db.php');
    $conn = new mysqli('localhost', 'root', '', 'school_supplies_eshop');
    if ($conn->connect_error) {
        die(json_encode(['status' => 'error', 'message' => 'DB Connection failed']));
    }

    $total_price = 0;
    foreach ($cart as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_email, customer_address, total_price, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssd", $customer_name, $customer_email, $customer_address, $total_price);
    $stmt->execute();

    $order_id = $conn->insert_id;

    foreach ($cart as $item) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, product_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiids", $order_id, $item['id'], $item['quantity'], $item['price'], $item['name']);
        $stmt->execute();
    }
    echo json_encode(['status' => 'success', 'message' => 'Order placed successfully!']);
}
