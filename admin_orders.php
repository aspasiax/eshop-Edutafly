<?php
include 'db.php';

$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders - Edutafly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            font-weight: 600;
        }
        .table thead {
            background-color: #198754;
            color: white;
        }
        .btn-sm {
            font-size: 0.8rem;
        }
        .order-box {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            padding: 25px;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <div class="order-box">
        <h1 class="mb-4 text-center"><i class="bi bi-clipboard-data"></i> Orders Overview</h1>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Total (€)</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="text-muted fw-semibold">#<?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_address']); ?></td>
                            <td>€<?php echo number_format($row['total_price'], 2); ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <a href="admin_order_details.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-eye-fill"></i> View
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
