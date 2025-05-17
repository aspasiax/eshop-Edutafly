<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Shopping Cart - Edutafly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>

body {
  background: #f7fafc;
  font-family: 'Poppins', sans-serif;
  color: #2c3e50;
}

main.container {
  max-width: 1140px;
  margin: auto;
  padding: 2.5rem 1.5rem;
}

h1 {
  font-weight: 800;
  color: #1e2a38;
  margin-bottom: 2.5rem;
  text-transform: uppercase;
  letter-spacing: 1.2px;
}

.cart-item {
  background: #ffffffcc;
  border-radius: 1.2rem;
  box-shadow: 0 8px 20px rgb(0 0 0 / 0.1);
  padding: 2rem 2rem;
  margin-bottom: 2rem;
  display: flex;
  gap: 1.8rem;
  align-items: center;
  flex-wrap: wrap;
  opacity: 0;
  animation: fadeIn 0.6s forwards;
}

@keyframes fadeIn {
  to { opacity: 1; }
}

.cart-item img {
  max-width: 120px;
  border-radius: 1rem;
  object-fit: cover;
  flex-shrink: 0;
  box-shadow: 0 4px 15px rgb(0 0 0 / 0.1);
  transition: transform 0.3s ease;
}
.cart-item img:hover {
  transform: scale(1.05);
}

.cart-details {
  flex-grow: 1;
  min-width: 240px;
}

.cart-details h5 {
  font-size: 1.5rem;
  font-weight: 800;
  color: #34495e;
  margin-bottom: 0.5rem;
  text-transform: capitalize;
  letter-spacing: 0.6px;
}

.cart-details p {
  font-size: 1rem;
  color: #95a5a6;
  margin-bottom: 1rem;
  min-height: 2.6rem;
}

.cart-controls {
  display: flex;
  align-items: center;
  gap: 1.8rem;
  flex-wrap: wrap;
}

.quantity-control {
  display: flex;
  align-items: center;
  gap: 0.8rem;
}

.quantity-control button {
  width: 40px;
  height: 40px;
  border-radius: 0.5rem;
  border: 1.5px solid #27ae60;
  background-color: #ecf9f1;
  font-weight: 900;
  font-size: 1.5rem;
  color: #27ae60;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.quantity-control button:hover {
  background-color: #27ae60;
  color: white;
  border-color: #1e8449;
}

.quantity-control input {
  width: 60px;
  text-align: center;
  border: 1.5px solid #bdc3c7;
  border-radius: 0.5rem;
  padding: 0.4rem 0;
  font-weight: 700;
  font-size: 1.1rem;
  color: #34495e;
  user-select: none;
  background-color: #f9f9f9;
}

.line-total {
  font-size: 1.4rem;
  font-weight: 800;
  color: #27ae60;
  min-width: 130px;
  text-align: right;
  letter-spacing: 0.8px;
  transition: color 0.3s ease;
}
.line-total:hover {
  color: #1e8449;
}

.remove-btn {
  background-color: #e74c3c;
  border: none;
  color: white;
  border-radius: 0.7rem;
  padding: 0.55rem 0.85rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
  font-size: 1.3rem;
  box-shadow: 0 4px 8px rgb(231 76 60 / 0.5);
}

.remove-btn:hover {
  background-color: #c0392b;
  box-shadow: 0 6px 15px rgb(192 57 43 / 0.7);
}

.sticky-summary {
  position: sticky;
  top: 1.5rem;
  background: #ffffff;
  border-radius: 1.2rem;
  padding: 2.5rem 2.5rem;
  box-shadow: 0 10px 30px rgb(0 0 0 / 0.15);
  height: fit-content;
}

.sticky-summary h4 {
  font-weight: 900;
  color: #27ae60;
  margin-bottom: 2rem;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.summary-row {
  display: flex;
  justify-content: space-between;
  margin-bottom: 1.4rem;
  font-size: 1.2rem;
  color: #34495e;
  letter-spacing: 0.3px;
}

.summary-row.total {
  font-weight: 900;
  font-size: 1.6rem;
  border-top: 3px solid #27ae60;
  padding-top: 1.2rem;
  margin-top: 1.8rem;
}

#checkout-btn {
  background-color: #27ae60;
  border: none;
  font-weight: 900;
  font-size: 1.25rem;
  padding: 0.8rem 0;
  border-radius: 0.8rem;
  transition: background-color 0.4s ease, box-shadow 0.3s ease;
  width: 100%;
  box-shadow: 0 8px 15px rgb(39 174 96 / 0.6);
}

#checkout-btn:disabled {
  background-color: #95a5a6;
  box-shadow: none;
  cursor: not-allowed;
}

#checkout-btn:hover:not(:disabled) {
  background-color: #1e8449;
  box-shadow: 0 10px 20px rgb(30 132 73 / 0.8);
}

#cart-items p.text-muted {
  font-size: 1.2rem;
  font-style: italic;
  margin-top: 3rem;
  color: #95a5a6;
  text-align: center;
  letter-spacing: 0.8px;
}

@media (max-width: 767.98px) {
  .cart-item {
    flex-direction: column;
    align-items: flex-start;
  }
  .cart-item img {
    max-width: 100%;
    width: 100%;
    height: auto;
    margin-bottom: 1.5rem;
    border-radius: 1rem;
  }
  .line-total {
    text-align: left;
    min-width: auto;
  }
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.cart-item.fade-in {
  animation: fadeIn 0.5s ease forwards;
}
</style>
</head>

<body>
<?php include 'header.php'; ?>

<main class="container my-5">
  <h1 class="mb-5 text-center">Shopping Cart</h1>

  <div class="row gx-5">
    <section class="col-lg-8" id="cart-items">
      <p class="text-muted text-center">Your cart is empty.</p>
    </section>

    <aside class="col-lg-4">
      <div class="sticky-summary">
        <h4>Order Summary</h4>
        <div class="summary-row">
          <span>Items (<span id="cart-count-summary">0</span>)</span>
          <span id="items-total-price">€0.00</span>
        </div>
        <div class="summary-row total">
          <span>Total</span>
          <span id="total-price">€0.00</span>
        </div>
        <a href="checkout.php" id="checkout-btn" class="btn w-100 mb-3" aria-disabled="false" disabled>
          Proceed to Checkout
        </a>
        <a href="products.php" class="btn btn-outline-secondary w-100">
          Continue Shopping
        </a>
      </div>
    </aside>
  </div>
</main>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="cart.js?v=3"></script>

<script>

function updateCartUI(cart) {
  const cartItemsEl = document.getElementById('cart-items');
  const cartCountEl = document.getElementById('cart-count');
  const cartCountSummaryEl = document.getElementById('cart-count-summary');
  const itemsTotalPriceEl = document.getElementById('items-total-price');
  const totalPriceEl = document.getElementById('total-price');
  const checkoutBtn = document.getElementById('checkout-btn');

  if (cart.length === 0) {
    cartItemsEl.innerHTML = '<p class="text-muted text-center">Your cart is empty.</p>';
    cartCountEl.textContent = '0';
    cartCountSummaryEl.textContent = '0';
    itemsTotalPriceEl.textContent = '€0.00';
    totalPriceEl.textContent = '€0.00';
    checkoutBtn.disabled = true;
    return;
  }

  cartCountEl.textContent = cart.length;
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
  cartCountSummaryEl.textContent = totalItems;

  cartItemsEl.innerHTML = ''; 

  cart.forEach((item, index) => {
    const article = document.createElement('article');
    article.className = 'cart-item';
    article.setAttribute('data-id', item.id);

    article.innerHTML = `
      ${item.image ? `<img src="${item.image}" alt="${item.name}">` : ''}
      <div class="cart-details">
        <h5>${item.name}</h5>
        <p>${item.description || ''}</p>
        <div class="cart-controls">
          <div class="quantity-control" aria-label="Quantity control for ${item.name}">
            <button class="decrease-qty btn btn-light" aria-label="Decrease quantity">−</button>
            <input type="text" value="${item.quantity}" readonly aria-live="polite" aria-atomic="true" />
            <button class="increase-qty btn btn-light" aria-label="Increase quantity">+</button>
          </div>
          <div class="fw-bold fs-5">Line Total: €${(item.price * item.quantity).toFixed(2)}</div>
          <button class="remove-btn" aria-label="Remove ${item.name}" title="Remove item">
            <i class="bi bi-trash-fill"></i>
          </button>
        </div>
      </div>
    `;

    article.style.opacity = 0;
    cartItemsEl.appendChild(article);

    setTimeout(() => {
      article.classList.add('fade-in');
      article.style.opacity = 1;
    }, index * 150);
  });

  const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
  itemsTotalPriceEl.textContent = `€${total.toFixed(2)}`;
  totalPriceEl.textContent = `€${total.toFixed(2)}`;
  checkoutBtn.disabled = false;

  document.querySelectorAll('.increase-qty').forEach(btn => {
    btn.onclick = e => {
      const itemEl = e.target.closest('.cart-item');
      const id = itemEl.dataset.id;
      window.cartIncreaseQuantity(id);
    };
  });
  document.querySelectorAll('.decrease-qty').forEach(btn => {
    btn.onclick = e => {
      const itemEl = e.target.closest('.cart-item');
      const id = itemEl.dataset.id;
      window.cartDecreaseQuantity(id);
    };
  });
  document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.onclick = e => {
      const itemEl = e.target.closest('.cart-item');
      const id = itemEl.dataset.id;
      window.cartRemoveItem(id);
    };
  });
}

  window.updateCartUI = updateCartUI;
</script>

</body>
</html>
