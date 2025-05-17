<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edutafly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2&family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f8f9fa;
  margin: 0;
  padding: 0;
}

/* Top banner */
.top-header {
  background-color: rgb(70, 97, 123); /* ίδιο με footer */
  color: #f1f1f1;
  font-family: 'Baloo 2', cursive;
  font-weight: 600;
  font-size: 0.95rem;
  padding: 6px 0;
  text-align: center;
  letter-spacing: 0.04em;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

/* Navbar styling */
nav.navbar {
  background-color: #ffffff;
  box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  padding: 0.8rem 1rem;
}

/* Logo */
.navbar-brand {
  font-family: 'Baloo 2', cursive;
  font-size: 1.9rem;
  font-weight: 700;
  color: rgb(70, 97, 123) !important;
  letter-spacing: 0.05em;
  display: flex;
  align-items: center;
  gap: 6px;
  transition: all 0.3s ease;
}

.navbar-brand:hover {
  color: #00b4d8 !important;
  text-shadow: 0 0 10px rgba(0, 180, 216, 0.5);
}

.navbar-brand i {
  font-size: 1.9rem;
  color: #00b4d8;
  transition: color 0.3s ease;
}

.navbar-brand:hover i {
  color: rgb(70, 97, 123);
}

.navbar-nav .nav-link {
  font-weight: 500;
  font-size: 1rem;
  color: #555 !important;
  transition: all 0.2s ease;
}

.navbar-nav .nav-link:hover, 
.navbar-nav .nav-link.active {
  color: rgb(70, 97, 123) !important;
  font-weight: 600;
}

.btn-outline-primary {
  border-radius: 30px;
  padding: 0.375rem 0.9rem;
  font-weight: 600;
  color: rgb(70, 97, 123);
  border-color: rgb(70, 97, 123);
  transition: background-color 0.3s ease, color 0.3s ease;
  position: relative;
}

.btn-outline-primary:hover {
  background-color: rgb(70, 97, 123);
  color: white;
}

#cart-count {
  position: absolute;
  top: -5px;
  right: -10px;
  font-size: 0.75rem;
  font-weight: 600;
  padding: 2px 6px;
  background-color: #dc3545;
  color: white;
  border-radius: 50%;
  line-height: 1;
  min-width: 20px;
  text-align: center;
}

  </style>
</head>
<body>

<div class="top-header">
  Welcome to Edutafly 📖✨
</div>

<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <i class="bi bi-book-half"></i> Edutafly
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
      </ul>
      <a href="cart.php" class="btn btn-outline-primary position-relative">
        <i class="bi bi-cart4 fs-5"></i>
        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
      </a>
    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function updateCartIcon() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cart-count').textContent = totalQuantity;
  }
  window.onload = updateCartIcon;
</script>

</body>
</html>
