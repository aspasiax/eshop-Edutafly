<?php

include 'db.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        echo "Product deleted successfully!";
    } else {
        echo "There was a problem deleting the product.";
    }

    $stmt->close();
    $conn->close();

    header("Location: admin_products.php");
    exit;
} else {
    echo "Product not found.";
}
?>
