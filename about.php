<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - Edutafly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="py-5 text-center text-white" style="background-color:rgb(95, 140, 207);">
  <div class="container">
    <h1 class="display-5 fw-bold">About Edutafly <i class="bi bi-book"></i></h1>
    <p class="lead">Your trusted partner for student essentials</p>
  </div>
</section>

<main>
  <div class="container my-5">
    <div class="card shadow-lg p-4">
      <h2 class="mb-4 text-primary"><i class="bi bi-butterfly"></i> Learn. Evolve. Fly.</h2>
      <p><strong>Edutafly</strong> is an online store designed especially for students! We offer a wide range of school and study essentials — from notebooks and pens to backpacks and other stationery supplies — all at affordable prices.</p>
      <p>Our mission is to make your student experience smoother and more organized by bringing everything you need into one easy-to-use and friendly platform.</p>
      <p>At <strong>Edutafly</strong>, we believe education is a journey — full of growth, transformation, and new beginnings. Just like a butterfly, you deserve the tools to spread your wings.</p>
      <p class="mb-0"><strong>Thank you for trusting us!</strong></p>
    </div>
  </div>
</main>

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
