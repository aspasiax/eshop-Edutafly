<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Invalid access');
}

$name       = $_POST['customer_name'] ?? '';
$email      = $_POST['customer_email'] ?? '';
$address    = $_POST['customer_address'] ?? '';
$cartData   = json_decode($_POST['cart_data'] ?? '[]', true);

if (!$name || !$email || !$address || empty($cartData)) {
    exit('Your cart is empty or missing some data.');
}

$total = 0;
foreach ($cartData as $i) {
    $total += $i['price'] * $i['quantity'];
}

$stmt = $conn->prepare(
  "INSERT INTO orders (customer_name, customer_email, customer_address, total_price, created_at) 
   VALUES (?, ?, ?, ?, NOW())"
);
$stmt->bind_param("sssd", $name, $email, $address, $total);
$stmt->execute();
$order_id = $stmt->insert_id;
$stmt->close();

$stmt2 = $conn->prepare(
  "INSERT INTO order_items (order_id, product_id, product_name, quantity, price) 
   VALUES (?, ?, ?, ?, ?)"
);
foreach ($cartData as $i) {
    $stmt2->bind_param("iisid",
      $order_id,
      $i['id'],
      $i['name'],
      $i['quantity'],
      $i['price']
    );
    $stmt2->execute();
}
$stmt2->close();

echo "<script>
        localStorage.removeItem('cart');
        window.location = 'confirmation.php?order_id={$order_id}';
      </script>";
exit;

