<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Home Page - Edutafly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<body>

<?php include 'header.php'; ?>

<section class="hero-section d-flex align-items-center">
  <div class="container">
    <h1 class="animated fadeInDown">Welcome to Edutafly</h1>
    <p class="animated fadeInUp delay-1s">Find the best school supplies, from notebooks and pens to backpacks and accessories.</p>
    <a href="products.php" class="btn btn-primary btn-lg mt-3">Browse Our Products</a>
  </div>
</section>

<section class="py-5 text-center bg-light">
  <div class="container">
    <h2 class="mb-4">Why Choose Us?</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card h-100 shadow-sm p-4 rounded-4">
          <i class="fas fa-cogs fa-3x mb-3 text-primary"></i>
          <h4>Easy Shopping</h4>
          <p>Shop quickly and easily through our online store.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card h-100 shadow-sm p-4 rounded-4">
          <i class="fas fa-euro-sign fa-3x mb-3 text-primary"></i>
          <h4>Competitive Prices</h4>
          <p>Great prices for high-quality products.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card h-100 shadow-sm p-4 rounded-4">
          <i class="fas fa-truck fa-3x mb-3 text-primary"></i>
          <h4>Fast Delivery</h4>
          <p>Fast delivery across Europe.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>


<script src="cart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
window.onload = function () {
    updateCartIcon();
};
</script>
</body>
</html>
