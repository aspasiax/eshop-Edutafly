<?php
include 'db.php';

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='container mt-5'><h3>Product not found!</h3></div>";
    exit;
}

$product = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edutafly - <?php echo htmlspecialchars($product['name']); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
  <link rel="stylesheet" href="style.css" />
  <style>
    .product-card {
      box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
      border-radius: 0.5rem;
      padding: 1.5rem;
      background: #fff;
      margin-bottom: 2rem;
    }
    .product-image {
      border-radius: 0.5rem;
      transition: transform 0.3s ease;
      max-height: 400px;
      object-fit: contain;
      width: 100%;
    }
    .product-image:hover {
      transform: scale(1.05);
    }
    .btn-back {
      text-decoration: none;
      font-weight: 600;
    }
    .btn-back i {
      margin-right: 5px;
    }
  </style>
</head>
<body>

<?php include 'header.php'; ?>

<main class="container mt-5">
  <div class="product-card row g-4 align-items-center">
    <div class="col-md-6">
      <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image" />
    </div>
    <div class="col-md-6">
      <h1 class="mb-3"><?php echo htmlspecialchars($product['name']); ?></h1>
      <p class="mb-4"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
      <h3 class="text-primary mb-4">€<?php echo number_format($product['price'], 2); ?></h3>
      <button 
        onclick="addToCart(<?php echo $product['id']; ?>, '<?php echo addslashes(htmlspecialchars($product['name'])); ?>', <?php echo $product['price']; ?>)" 
        class="btn btn-lg btn-primary px-4"
      >
        <i class="bi bi-cart-plus me-2"></i> Add to cart
      </button>
      <div class="mt-4">
        <a href="products.php" class="btn btn-outline-secondary btn-back">
          <i class="bi bi-arrow-left"></i> Back to Products
        </a>
      </div>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="cart.js"></script>
<script>
function addToCart(id, name, price) {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  const existing = cart.find(item => item.id === id);
  if (existing) {
    existing.quantity += 1;
  } else {
    cart.push({ id, name, price, quantity: 1 });
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartIcon();
}

function updateCartIcon() {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  let totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
  document.getElementById('cart-count').textContent = totalQuantity;
}

window.onload = function () {
  updateCartIcon();
};
</script>

</body>
</html>
