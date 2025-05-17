<?php
include 'db.php';

$sql = "SELECT product_id, product_name, COUNT(*) as purchase_count 
        FROM order_items 
        GROUP BY product_id, product_name 
        ORDER BY purchase_count DESC 
        LIMIT 5";
$result = $conn->query($sql);

$labels = [];
$data = [];
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['product_name'] ?: "Product #" . $row['product_id'];
    $data[] = $row['purchase_count'];
}

$totalProducts = $conn->query("SELECT COUNT(*) as total FROM products")->fetch_assoc()['total'];
$totalOrders = $conn->query("SELECT COUNT(*) as total FROM orders")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Edutafly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-box {
            background: linear-gradient(to right, #e9fbee, #f8f9fa);
            border-radius: 0.75rem;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }
        .dashboard-box:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        .chart-title {
            font-weight: 600;
            color: #198754;
        }
        .stat-card {
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
<div class="container-lg mt-5">

    <div class="row text-center mb-4">
        <div class="col-md-6 mb-3">
            <div class="card stat-card border-0">
                <div class="card-body">
                    <h5 class="card-title text-success"><i class="bi bi-box-seam"></i> Total Products</h5>
                    <p class="fs-4"><?php echo $totalProducts; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card stat-card border-0">
                <div class="card-body">
                    <h5 class="card-title text-primary"><i class="bi bi-receipt"></i> Total Orders</h5>
                    <p class="fs-4"><?php echo $totalOrders; ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="chart-title"><i class="bi bi-bar-chart"></i> Most Purchased Products</h2>
        <a href="admin_orders.php" class="btn btn-outline-success"><i class="bi bi-list-ul"></i> View All Orders</a>
    </div>

    <div class="dashboard-box">
        <canvas id="productChart" height="100"></canvas>
    </div>
</div>

<script>
    const ctx = document.getElementById('productChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Times Purchased',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(25, 135, 84, 0.4)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' purchase(s)';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                }
            }
        }
    });
</script>
</body>
</html>
