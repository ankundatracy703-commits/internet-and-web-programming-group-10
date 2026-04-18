// Cart functionality
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function handleLoginForm(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    fetch('api/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.role === 'admin') {
                window.location.href = 'admin_dashboard.php';
            } else {
                window.location.href = 'user_dashboard.php';
            }
        } else {
            showToast(data.message || 'Login failed');
        }
    })
    .catch(error => {
        showToast('An error occurred');
    });
}

function handleRegisterForm(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    fetch('api/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Registration successful! Please login.');
            event.target.reset();
            setTimeout(() => window.location.href = 'login.php', 1500);
        } else {
            showToast(data.message || 'Registration failed');
        }
    })
    .catch(error => {
        showToast('An error occurred');
    });
}

function updateCartDisplay() {
    const cartCount = document.getElementById('cartCount');
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    if (cartCount) {
        cartCount.textContent = totalItems;
    }
}

function addToCart(id, name, price) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({ id, name, price, quantity: 1 });
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
    showToast(`${name} added to cart!`);
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
    renderCartItems();
}

function updateQuantity(id, change) {
    const item = cart.find(item => item.id === id);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(id);
        } else {
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCartItems();
            updateCartDisplay();
        }
    }
}

function getCartTotal() {
    return cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
}

function renderCartItems() {
    const cartItemsContainer = document.getElementById('cartItems');
    if (!cartItemsContainer) return;
    
    if (cart.length === 0) {
        cartItemsContainer.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">🛒</div>
                <p>Your cart is empty</p>
                <a href="menu.php" class="btn btn-primary">Browse Menu</a>
            </div>
        `;
        return;
    }
    
    let html = '';
    cart.forEach(item => {
        html += `
            <div class="cart-item">
                <div class="cart-item-image">🍽️</div>
                <div class="cart-item-info">
                    <h4>${item.name}</h4>
                    <p>$${item.price.toFixed(2)} each</p>
                </div>
                <div class="cart-item-controls">
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
                </div>
                <div>
                    <p>$${(item.price * item.quantity).toFixed(2)}</p>
                    <button class="btn btn-danger" onclick="removeFromCart(${item.id})">Remove</button>
                </div>
            </div>
        `;
    });
    
    cartItemsContainer.innerHTML = html;
    document.getElementById('cartTotal').textContent = '$' + getCartTotal().toFixed(2);
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #27ae60;
        color: white;
        padding: 1rem 2rem;
        border-radius: 8px;
        z-index: 3000;
        animation: fadeIn 0.3s;
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}

function filterMenu(categoryId) {
    const items = document.querySelectorAll('.menu-item');
    items.forEach(item => {
        if (categoryId === 'all' || item.dataset.category === categoryId) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    
    document.querySelectorAll('.menu-tab').forEach(tab => {
        tab.classList.remove('active');
    });
    event.target.classList.add('active');
}

function searchMenu(query) {
    const items = document.querySelectorAll('.menu-item');
    query = query.toLowerCase();
    items.forEach(item => {
        const name = item.querySelector('h3').textContent.toLowerCase();
        const description = item.querySelector('p').textContent.toLowerCase();
        if (name.includes(query) || description.includes(query)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}

function handleReservationForm(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    
    fetch('api/reservation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Reservation confirmed!');
            event.target.reset();
        } else {
            showToast(data.message || 'Failed to make reservation');
        }
    })
    .catch(error => {
        showToast('An error occurred');
    });
}

function handleOrderForm(event) {
    event.preventDefault();
    const formData = new FormData(event.target);
    formData.append('items', JSON.stringify(cart));
    formData.append('total', getCartTotal());
    
    fetch('api/place_order.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Order placed successfully!');
            cart = [];
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
            window.location.href = 'user_dashboard.php';
        } else {
            showToast(data.message || 'Failed to place order');
        }
    })
    .catch(error => {
        showToast('An error occurred');
    });
}

function updateOrderStatus(orderId, status) {
    fetch('api/update_order.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ order_id: orderId, status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            showToast('Failed to update status');
        }
    });
}

function confirmDelete(message) {
    return confirm(message || 'Are you sure you want to delete this?');
}

document.addEventListener('DOMContentLoaded', function() {
    updateCartDisplay();
    
    const currentPage = window.location.pathname.split('/').pop();
    if (currentPage === 'cart.php') {
        renderCartItems();
    }
});

function clearCart() {
    cart = [];
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartDisplay();
    renderCartItems();
}