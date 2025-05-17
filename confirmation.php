<?php
include 'db.php';

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
if ($order_id === 0) {
    echo "Order not found!";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    echo "Order not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation - Edutafly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e3f2fd, #fbe9e7);
            font-family: 'Segoe UI', sans-serif;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .confirmation-wrapper {
            max-width: 900px;
            margin: 4rem auto;
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            padding: 3rem;
            position: relative;
        }

        .confirmation-header i {
            font-size: 4rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-top: 2rem;
            color: #444;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 0.5rem;
        }

        .list-group-item {
            font-size: 0.95rem;
            padding: 0.75rem 1rem;
        }

        .back-home {
            margin-top: 2rem;
        }

        .print-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .countdown-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="confirmation-wrapper">

    <button onclick="window.print();" class="btn btn-outline-secondary print-btn">
        <i class="bi bi-printer"></i> Print
    </button>

    <div class="text-center confirmation-header mb-4">
        <i class="bi bi-check-circle-fill text-success"></i>
        <h2 class="mt-3">Thank You for Your Order!</h2>
        <p class="text-muted">Your order has been successfully placed. You will receive an email shortly with all the details.</p>
    </div>

    <div class="section-title">
        <i class="bi bi-receipt me-2"></i>Order Summary
    </div>
    <div class="row g-4">
        <div class="col-md-6">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($order['customer_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($order['customer_email']); ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Address:</strong> <?php echo nl2br(htmlspecialchars($order['customer_address'])); ?></p>
            <p><strong>Total:</strong> €<?php echo number_format($order['total_price'], 2); ?></p>
        </div>
    </div>

    <div class="section-title mt-4">
        <i class="bi bi-box-seam me-2"></i>Items Ordered
    </div>
    <ul class="list-group list-group-flush mb-3">
        <?php
        $sql_items = "SELECT * FROM order_items WHERE order_id = $order_id";
        $result_items = $conn->query($sql_items);
        while ($item = $result_items->fetch_assoc()) {
            echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
            echo htmlspecialchars($item['product_name']);
            echo '<span class="badge bg-info text-dark">€' . number_format($item['price'], 2) . ' × ' . $item['quantity'] . '</span>';
            echo '</li>';
        }
        ?>
    </ul>

    <div class="text-center back-home">
        <a href="index.php" class="btn btn-primary">
            <i class="bi bi-house-door-fill me-1"></i>Back to Home
        </a>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="cart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    localStorage.removeItem('cart');    
</script>

</body>
</html>
