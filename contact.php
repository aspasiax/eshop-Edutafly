<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - Edutafly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'header.php'; ?>

<section class="py-5 text-center text-white" style="background-color:rgb(95, 140, 207);">
  <div class="container">
    <h1 class="display-5 fw-bold">Get in Touch</h1>
    <p class="lead">We'd love to hear from you!</p>
  </div>
</section>

<main class="my-5">
  <div class="container">
    <div class="card shadow-lg p-4">
      <h3 class="text-primary mb-3"><i class="bi bi-envelope-paper-heart"></i> Contact Form</h3>
      <form action="#" method="POST">
        <div class="mb-3">
          <label for="name" class="form-label">Your Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="mb-3">
          <label for="email" class="form-label">Your Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="mb-3">
          <label for="message" class="form-label">Your Message</label>
          <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-send"></i> Send Message
        </button>
      </form>
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
