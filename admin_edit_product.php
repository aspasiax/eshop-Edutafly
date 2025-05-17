<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: admin_products.php");
    exit();
}

$id = intval($_GET['id']);

// Αν έχει υποβληθεί η φόρμα
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $stmt = $conn->prepare("UPDATE products SET name=?, category=?, price=?, description=?, image=? WHERE id=?");
        $stmt->bind_param("ssdssi", $name, $category, $price, $description, $image, $id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, category=?, price=?, description=? WHERE id=?");
        $stmt->bind_param("ssdsi", $name, $category, $price, $description, $id);
    }

    $stmt->execute();
    header("Location: admin_products.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Edutafly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4">Edit Product</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" name="category" id="category" value="<?= htmlspecialchars($product['category']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (€)</label>
            <input type="number" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" name="description" id="description" value="<?= htmlspecialchars($product['description']) ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <small class="text-muted">Current image: <?= htmlspecialchars($product['image']) ?></small>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="admin_products.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
