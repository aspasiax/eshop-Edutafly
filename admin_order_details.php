<?php
include 'db.php';

$order = null;
$order_items_result = null;

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $sql = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_result = $stmt->get_result();
    $order = $order_result->fetch_assoc();

    if (!$order) {
        echo "Order not found!";
        exit;
    }

    $sql = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order_items_result = $stmt->get_result();
} else {
    echo "No order ID was provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Details #<?php echo $order['id']; ?> - Edutafly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-header {
            background-color: #198754;
            color: white;
            padding: 15px;
            border-radius: 0.5rem;
            margin-bottom: 20px;
        }
        .table th {
            background-color: #198754;
            color: white;
        }
    </style>
</head>
<body>
<div class="container mt-5">

    <div class="order-header">
        <h2><i class="bi bi-receipt"></i> Order #<?php echo $order['id']; ?></h2>
        <p class="mb-0"><strong>Customer:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
        <p class="mb-0"><strong>Email:</strong> <?php echo htmlspecialchars($order['customer_email']); ?></p>
        <p class="mb-0"><strong>Address:</strong> <?php echo htmlspecialchars($order['customer_address']); ?></p>
        <p class="mb-0"><strong>Order Date:</strong> <?php echo $order['created_at']; ?></p>
        <p class="mb-0"><strong>Total:</strong> €<?php echo number_format($order['total_price'], 2); ?></p>
    </div>

    <h4 class="mb-3">🛒 Products in this Order:</h4>

    <div class="table-responsive">
        <table class="table table-bordered shadow-sm bg-white rounded">
            <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Price (€)</th>
                    <th scope="col">Total (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $order_items_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>€<?php echo number_format($item['price'], 2); ?></td>
                        <td>€<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <a href="admin_orders.php" class="btn btn-secondary mt-3">
        <i class="bi bi-arrow-left"></i> Back to Orders
    </a>
</div>
</body>
</html>
