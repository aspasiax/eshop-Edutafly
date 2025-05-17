document.addEventListener('DOMContentLoaded', () => {
  let cart = JSON.parse(localStorage.getItem('cart')) || [];
  const MAX_QUANTITY = 10;

  function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartIcon();
  }

  function updateCartIcon() {
    const totalQuantity = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartCount = document.getElementById('cart-count');
    if (cartCount) {
      cartCount.textContent = totalQuantity;
    }
  }

  function updateCheckoutButton() {
  const checkoutBtn = document.getElementById('checkout-btn');
  if (!checkoutBtn) return;

  if (cart.length === 0) {
    checkoutBtn.classList.add('disabled');
    checkoutBtn.setAttribute('aria-disabled', 'true');
    checkoutBtn.removeAttribute('href');
  } else {
    checkoutBtn.classList.remove('disabled');
    checkoutBtn.setAttribute('aria-disabled', 'false');
    checkoutBtn.setAttribute('href', 'checkout.php');
  }
}


  function updateUI() {
    if (typeof window.updateCartUI === 'function') {
      window.updateCartUI(cart);
    }

    const emptyMsg = document.getElementById('emptyCartMessage');
    if (emptyMsg) {
      emptyMsg.style.display = cart.length === 0 ? 'block' : 'none';
    }
    updateCartIcon();
  }

  window.cartAddItem = function (item) {
    const existing = cart.find(p => p.id === item.id);
    if (existing) {
      if (existing.quantity < MAX_QUANTITY) {
        existing.quantity += item.quantity;
      } else {
        alert('Maximum quantity reached!');
        return;
      }
    } else {
      cart.push({ ...item, quantity: Math.min(item.quantity, MAX_QUANTITY) });
    }

    saveCart();
    updateUI();

    const addButton = document.querySelector(`[data-product-id="${item.id}"]`);
    if (addButton) {
      const original = addButton.innerHTML;
      addButton.innerHTML = '✅ Added!';
      addButton.disabled = true;
      setTimeout(() => {
        addButton.innerHTML = original;
        addButton.disabled = false;
      }, 1000);
    }
  };

  window.cartIncreaseQuantity = function (id) {
    const item = cart.find(p => p.id == id);
    if (item && item.quantity < MAX_QUANTITY) {
      item.quantity += 1;
      saveCart();
      updateUI();
    } else if (item) {
      alert('Maximum quantity reached!');
    }
  };

  window.cartDecreaseQuantity = function (id) {
    const item = cart.find(p => p.id == id);
    if (item && item.quantity > 1) {
      item.quantity -= 1;
    } else {
      cart = cart.filter(p => p.id != id);
    }
    saveCart();
    updateUI();
  };

  window.cartRemoveItem = function (id) {
    cart = cart.filter(p => p.id != id);

    const row = document.getElementById(`cart-row-${id}`);
    if (row) {
      row.classList.add('fade-out');
      setTimeout(() => {
        row.remove();
        saveCart();
        updateUI();
      }, 300);
    } else {
      saveCart();
      updateUI();
    }
  };

  window.cartGetItems = function () {
    return cart;
  };

  window.addToCart = function (id, name, price) {
    const existing = cart.find(item => item.id === id);
    if (existing) {
      if (existing.quantity < MAX_QUANTITY) {
        existing.quantity += 1;
      } else {
        alert('Maximum quantity reached!');
        return;
      }
    } else {
      cart.push({ id, name, price, quantity: 1 });
    }
    saveCart();
    updateUI();
  };

  updateUI();
});
