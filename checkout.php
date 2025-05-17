<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'] ?? null;
    $customer_email = $_POST['customer_email'] ?? null;
    $total_price = $_POST['total_price'] ?? 0;
    $address = $_POST['address'] ?? null;
    $cart_json = $_POST['cart_data'] ?? null;

    if (!$customer_name || !$customer_email) {
        die("Name and email are required.");
    }

    if (!$cart_json) {
        die("Cart data missing.");
    }

    $cart = json_decode($cart_json, true);
    if (!$cart || !is_array($cart)) {
        die("Invalid cart data.");
    }

    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_email, customer_address, total_price, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssd", $customer_name, $customer_email, $address, $total_price);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    foreach ($cart as $item) {
        if (!isset($item['id'], $item['quantity'], $item['price'], $item['name'])) continue;

        $product_id = intval($item['id']);
        $quantity = intval($item['quantity']);
        $price = floatval($item['price']);
        $product_name = $item['name'];

        $stmt_item = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price, product_name) VALUES (?, ?, ?, ?, ?)");
        $stmt_item->bind_param("iiids", $order_id, $product_id, $quantity, $price, $product_name);
        $stmt_item->execute();
    }

    header("Location: confirmation.php?order_id=" . $order_id);
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout – Edutafly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .checkout-wrapper {
      max-width: 960px;
      margin: 3rem auto;
      background: #ffffff;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }

    .checkout-title {
      font-weight: 600;
      margin-bottom: 1.5rem;
    }

    .cart-preview li {
      font-size: 0.95rem;
    }

    .form-label {
      font-weight: 500;
    }

    .btn-success {
      width: 100%;
      padding: 0.75rem;
      font-weight: 500;
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
  <div class="checkout-wrapper">
    <h2 class="checkout-title">Complete Your Order</h2>

    <div id="checkout-cart-preview" class="cart-preview mb-4"></div>

    <form id="checkout-form" action="checkout.php" method="POST">
      <input type="hidden" name="cart_data" id="cart-data">
      <input type="hidden" name="total_price" id="total_price">

      <div class="mb-3">
        <label for="customer_name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="customer_name" name="customer_name" required>
      </div>

      <div class="mb-3">
        <label for="customer_email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="customer_email" name="customer_email" required>
      </div>

      <div class="mb-4">
        <label for="address" class="form-label">Shipping Address</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>

      <button type="submit" class="btn btn-success">Place Order</button>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
(function renderCartPreview() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const preview = document.getElementById("checkout-cart-preview");
  const totalInput = document.getElementById("total_price");

  if (!cart.length) {
    preview.innerHTML = "<p class='text-danger'>Your cart is empty.</p>";
    totalInput.value = 0;
    return;
  }

  let html = "<ul class='list-group mb-3'>";
  let total = 0;
  let totalItems = 0;

  cart.forEach(item => {
    const subtotal = item.price * item.quantity;
    total += subtotal;
    totalItems += item.quantity;

    html += `<li class="list-group-item d-flex justify-content-between align-items-center">
               <span>${item.name} ×${item.quantity}</span>
               <strong>€${subtotal.toFixed(2)}</strong>
             </li>`;
  });

  html += `<li class="list-group-item d-flex justify-content-between align-items-center bg-light fw-semibold">
             Total:
             <span>€${total.toFixed(2)}</span>
           </li></ul>`;

  html += `<div class="mt-2 text-end text-muted">Items: ${totalItems}</div>`;

  preview.innerHTML = html;
  totalInput.value = total.toFixed(2);
})();

  document.getElementById("checkout-form").addEventListener("submit", function () {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    document.getElementById("cart-data").value = JSON.stringify(cart);
  });
</script>

</body>
</html>
