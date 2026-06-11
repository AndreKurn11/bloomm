// ===== BLOOM CAFÉ — CART SYSTEM =====

let cart = JSON.parse(localStorage.getItem('bloom_cart') || '[]');

// ─── Open / Close ───────────────────────────────────────
function toggleCart() {
  const isOpen = document.getElementById('cart-drawer').classList.contains('open');
  if (isOpen) closeCart();
  else openCart();
}

function openCart() {
  renderCart();
  document.getElementById('cart-drawer').classList.add('open');
  document.getElementById('cart-overlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}

function closeCart() {
  document.getElementById('cart-drawer').classList.remove('open');
  document.getElementById('cart-overlay').classList.remove('show');
  document.body.style.overflow = '';
}

// ─── Add to Cart ────────────────────────────────────────
function addToCart(id, name, price, image) {
  const sid = String(id);
  const existing = cart.find(i => i.id === sid);
  if (existing) {
    existing.qty += 1;
  } else {
    cart.push({
      id: sid,
      name: name,
      price: parseInt(price),
      image: image || '/images/placeholder.jpg',
      qty: 1
    });
  }
  saveCart();
  updateCartCount();
  bounceBadge();
  showToast(name);
}

// ─── Quantity & Remove ──────────────────────────────────
function changeQty(id, delta) {
  const sid = String(id);
  const item = cart.find(i => i.id === sid);
  if (!item) return;
  item.qty += delta;
  if (item.qty <= 0) cart = cart.filter(i => i.id !== sid);
  saveCart();
  updateCartCount();
  renderCart();
}

function removeItem(id) {
  cart = cart.filter(i => i.id !== String(id));
  saveCart();
  updateCartCount();
  renderCart();
}

function clearCart() {
  if (!confirm('Hapus semua item dari keranjang?')) return;
  cart = [];
  saveCart();
  updateCartCount();
  renderCart();
}

// ─── Render ─────────────────────────────────────────────
function renderCart() {
  const body   = document.getElementById('cart-body');
  const footer = document.getElementById('cart-footer');
  if (!body) return;

  if (cart.length === 0) {
    body.innerHTML = `
      <div class="cart-empty">
        <i class="bi bi-cup-hot"></i>
        <p class="fw-semibold mb-1">Keranjang kosong</p>
        <p class="small text-muted">Tambahkan menu favoritmu!</p>
      </div>`;
    if (footer) footer.innerHTML = '';
    return;
  }

  let html  = '';
  let total = 0;

  cart.forEach(item => {
    const subtotal = item.price * item.qty;
    total += subtotal;

    html += `
      <div class="cart-item" data-id="${item.id}">
        <img
          class="cart-item-img"
          src="${item.image}"
          alt="${item.name}"
          onerror="this.src='/images/placeholder.jpg'">
        <div class="cart-item-info">
          <div class="cart-item-name">${item.name}</div>
          <div class="cart-item-price">Rp ${rupiah(item.price)}</div>
          <div class="qty-controls mt-1">
            <button class="qty-btn" onclick="changeQty('${item.id}', -1)">−</button>
            <span class="qty-value">${item.qty}</span>
            <button class="qty-btn" onclick="changeQty('${item.id}', 1)">+</button>
          </div>
        </div>
        <div class="d-flex flex-column align-items-end gap-2">
          <span class="fw-bold small">Rp ${rupiah(subtotal)}</span>
          <button class="remove-btn" onclick="removeItem('${item.id}')" title="Hapus">
            <i class="bi bi-trash3"></i>
          </button>
        </div>
      </div>`;
  });

  body.innerHTML = html;

  if (footer) {
    footer.innerHTML = `
      <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted small">${cart.length} item</span>
        <span class="fw-bold fs-5" style="color:var(--primary,#0d6efd)">
          Rp ${rupiah(total)}
        </span>
      </div>
      <button
        class="btn btn-primary w-100 rounded-pill fw-semibold py-2 mb-2"
        id="checkout-btn"
        onclick="proceedToPayment()">
        Lanjut ke Checkout →
      </button>
      <button
        class="btn btn-outline-secondary w-100 rounded-pill btn-sm"
        onclick="clearCart()">
        Kosongkan Keranjang
      </button>`;
  }
}

// ─── Checkout ───────────────────────────────────────────
// Flow:
// 1. POST /checkout/session  → Laravel simpan cart ke session
// 2. Jika sukses             → JS redirect ke GET /checkout
// 3. CheckoutController::index() baca session → tampil halaman checkout
async function proceedToPayment() {
  if (cart.length === 0) {
    alert('Keranjangmu masih kosong!');
    return;
  }

  const btn = document.getElementById('checkout-btn');
  if (btn) { btn.disabled = true; btn.textContent = 'Memproses...'; }

  const tokenEl = document.querySelector('meta[name="csrf-token"]');
  if (!tokenEl) {
    alert('CSRF token tidak ditemukan. Pastikan <meta name="csrf-token"> ada di <head>.');
    if (btn) { btn.disabled = false; btn.textContent = 'Lanjut ke Checkout →'; }
    return;
  }

  // Konversi qty → quantity agar cocok dengan format session di CheckoutController
  const sessionCart = cart.map(item => ({
    id:       item.id,
    name:     item.name,
    price:    item.price,
    image:    item.image,
    quantity: item.qty
  }));

  try {
    const res = await fetch('/checkout/session', {
      method:  'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': tokenEl.content,
        'Accept':       'application/json',
      },
      body: JSON.stringify({ cart: sessionCart })
    });

    const data = await res.json();

    if (data.success) {
      window.location.href = '/checkout';
    } else {
      alert(data.message || 'Terjadi kesalahan, coba lagi.');
      if (btn) { btn.disabled = false; btn.textContent = 'Lanjut ke Checkout →'; }
    }
  } catch (err) {
    console.error('Checkout error:', err);
    alert('Gagal terhubung ke server. Coba lagi.');
    if (btn) { btn.disabled = false; btn.textContent = 'Lanjut ke Checkout →'; }
  }
}

// ─── Helpers ────────────────────────────────────────────
function saveCart() {
  localStorage.setItem('bloom_cart', JSON.stringify(cart));
}

function updateCartCount() {
  const total = cart.reduce((sum, i) => sum + i.qty, 0);
  const badge = document.getElementById('cart-count');
  if (badge) badge.textContent = total;
}

function rupiah(num) {
  return Number(num).toLocaleString('id-ID');
}

function bounceBadge() {
  const badge = document.getElementById('cart-count');
  if (!badge) return;
  badge.classList.remove('badge-bounce');
  void badge.offsetWidth;
  badge.classList.add('badge-bounce');
  setTimeout(() => badge.classList.remove('badge-bounce'), 400);
}

function showToast(name) {
  let toast = document.getElementById('bloom-toast');
  if (!toast) {
    toast = document.createElement('div');
    toast.id = 'bloom-toast';
    toast.style.cssText = `
      position:fixed;bottom:24px;left:50%;transform:translateX(-50%) translateY(20px);
      background:#1a1a2e;color:#fff;padding:10px 20px;border-radius:50px;
      font-size:0.85rem;font-weight:600;opacity:0;transition:all 0.3s ease;
      z-index:9999;white-space:nowrap;pointer-events:none;
    `;
    document.body.appendChild(toast);
  }
  toast.textContent = `✅ ${name} ditambahkan ke keranjang`;
  toast.style.opacity = '1';
  toast.style.transform = 'translateX(-50%) translateY(0)';
  clearTimeout(toast._timer);
  toast._timer = setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(-50%) translateY(20px)';
  }, 2200);
}

// ─── Inject Cart CSS ────────────────────────────────────
(function injectCartStyles() {
  if (document.getElementById('bloom-cart-styles')) return;
  const style = document.createElement('style');
  style.id = 'bloom-cart-styles';
  style.textContent = `
    #cart-overlay {
      display:none;position:fixed;inset:0;
      background:rgba(0,0,0,0.45);z-index:1054;
    }
    #cart-overlay.show { display:block; }

    #cart-drawer {
      position:fixed;top:0;right:-420px;width:400px;max-width:100vw;
      height:100vh;background:#fff;
      box-shadow:-4px 0 32px rgba(0,0,0,0.13);
      z-index:1055;transition:right 0.35s cubic-bezier(.4,0,.2,1);
      display:flex;flex-direction:column;border-radius:16px 0 0 16px;
    }
    #cart-drawer.open { right:0; }

    .cart-header {
      padding:20px 24px;border-bottom:1px solid #eee;
      display:flex;align-items:center;justify-content:space-between;flex-shrink:0;
    }
    .cart-close-btn {
      width:34px;height:34px;border-radius:50%;border:none;
      background:#f4f4f8;color:#555;cursor:pointer;font-size:1rem;
      display:flex;align-items:center;justify-content:center;transition:background 0.2s;
    }
    .cart-close-btn:hover { background:#e0e0e8; }

    .cart-body { flex:1;overflow-y:auto;padding:12px 20px; }

    #cart-footer {
      padding:16px 20px;border-top:1px solid #eee;
      background:#f8f9ff;border-radius:0 0 0 16px;flex-shrink:0;
    }

    .cart-empty { text-align:center;padding:56px 20px;color:#aaa; }
    .cart-empty i { font-size:3rem;display:block;margin-bottom:12px; }

    .cart-item {
      display:flex;align-items:center;gap:12px;
      padding:12px 0;border-bottom:1px solid #f2f2f2;
    }
    .cart-item:last-child { border-bottom:none; }
    .cart-item-img {
      width:58px;height:58px;object-fit:cover;
      border-radius:10px;flex-shrink:0;background:#eef2ff;
    }
    .cart-item-info { flex:1;min-width:0; }
    .cart-item-name {
      font-weight:600;font-size:0.88rem;color:#1a1a2e;
      white-space:nowrap;overflow:hidden;text-overflow:ellipsis;
    }
    .cart-item-price { font-size:0.8rem;color:#0d6efd;font-weight:600;margin-top:2px; }

    .qty-controls { display:flex;align-items:center;gap:6px;margin-top:6px; }
    .qty-btn {
      width:26px;height:26px;border-radius:50%;
      border:1.5px solid #0d6efd;background:#fff;color:#0d6efd;
      font-size:0.95rem;font-weight:700;cursor:pointer;
      display:flex;align-items:center;justify-content:center;
      transition:all 0.15s;line-height:1;padding:0;
    }
    .qty-btn:hover { background:#0d6efd;color:#fff; }
    .qty-value { min-width:22px;text-align:center;font-weight:700;font-size:0.88rem; }

    .remove-btn {
      background:none;border:none;color:#dc3545;cursor:pointer;
      font-size:1rem;padding:4px 6px;border-radius:6px;transition:background 0.15s;
    }
    .remove-btn:hover { background:#fff0f0; }

    @keyframes badgeBounce {
      0%   { transform:scale(1); }
      40%  { transform:scale(1.6); }
      70%  { transform:scale(0.9); }
      100% { transform:scale(1); }
    }
    .badge-bounce { animation:badgeBounce 0.4s ease; }

    @media (max-width:480px) {
      #cart-drawer { width:100vw;border-radius:0; }
    }
  `;
  document.head.appendChild(style);
})();

// ─── Init ────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  updateCartCount();
  const overlay = document.getElementById('cart-overlay');
  if (overlay) overlay.addEventListener('click', closeCart);
});