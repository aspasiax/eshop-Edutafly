<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Edutafly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card i {
            font-size: 2rem;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">🔧 Admin Panel - Edutafly</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
        <div class="col">
            <a href="admin_dashboard.php" class="text-decoration-none">
                <div class="card p-4 text-center">
                    <i class="bi bi-speedometer2 mb-2"></i>
                    <h5 class="card-title">Dashboard</h5>
                    <p class="text-muted">Overview and statistics</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="admin_products.php" class="text-decoration-none">
                <div class="card p-4 text-center">
                    <i class="bi bi-box-seam mb-2"></i>
                    <h5 class="card-title">Manage Products</h5>
                    <p class="text-muted">View & edit all products</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="admin_add_product.php" class="text-decoration-none">
                <div class="card p-4 text-center">
                    <i class="bi bi-plus-square mb-2"></i>
                    <h5 class="card-title">Add Product</h5>
                    <p class="text-muted">Insert new product into store</p>
                </div>
            </a>
        </div>

        <div class="col">
            <a href="admin_orders.php" class="text-decoration-none">
                <div class="card p-4 text-center">
                    <i class="bi bi-receipt mb-2"></i>
                    <h5 class="card-title">View Orders</h5>
                    <p class="text-muted">Check customer orders</p>
                </div>
            </a>
        </div>
    </div>
</div>
</body>
</html>
