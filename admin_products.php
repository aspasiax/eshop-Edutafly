<?php
include 'db.php'; 

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products - Edutafly</title>
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
            background-color: #0d6efd;
            color: white;
        }
        .btn-sm {
            font-size: 0.8rem;
        }
        img {
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">📦 Product Management</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="admin_add_product.php" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Product
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm bg-white rounded">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price (€)</th>
                    <th scope="col">Image</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-muted fw-light"><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td>€<?php echo number_format($row['price'], 2); ?></td>
                        <td>
                            <img src="images/<?php echo htmlspecialchars($row['image']); ?>" width="60" alt="Product Image">
                        </td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <a href="admin_edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm mb-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <br>
                            <a href="admin_delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
