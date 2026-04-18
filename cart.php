<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - DineEasy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="all.min.css">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline';">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
</head>
<body>
    <header>
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo">Dine<span>Easy</span></a>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="reservation.php">Reservations</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="cart.php" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" id="cartCount">0</span>
                    </a>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="user_dashboard.php" class="btn btn-outline">Dashboard</a>
                        <a href="api/logout.php" class="btn btn-primary">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline">Login</a>
                        <a href="register.php" class="btn btn-primary">Sign Up</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <section class="cart-section">
        <div class="container">
            <div class="section-title">
                <h2>Your Cart</h2>
                <p>Review your items before checkout</p>
            </div>

            <div class="cart-container">
                <div class="cart-items">
                    <div id="cartItems">
                        <div class="empty-state">
                            <div class="empty-state-icon">🛒</div>
                            <p>Your cart is empty</p>
                            <a href="menu.php" class="btn btn-primary">Browse Menu</a>
                        </div>
                    </div>
                </div>

                <div class="cart-summary">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="cartSubtotal">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (10%)</span>
                        <span id="cartTax">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Delivery</span>
                        <span>$5.00</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="cartTotal">$0.00</span>
                    </div>

                    <form id="orderForm" onsubmit="handleOrderForm(event)" style="margin-top: 1rem;">
                        <div class="form-group">
                            <label for="deliveryAddress">Delivery Address</label>
                            <textarea id="deliveryAddress" name="delivery_address" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="paymentMethod">Payment Method</label>
                            <select id="paymentMethod" name="payment_method">
                                <option value="cash">Cash on Delivery</option>
                                <option value="card">Credit/Debit Card</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Place Order</button>
                    </form>

                    <button onclick="clearCart()" class="btn btn-outline" style="width: 100%; margin-top: 1rem;">Clear Cart</button>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>DineEasy</h3>
                    <p>Your favorite restaurant, now just a click away.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="reservation.php">Reservations</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Sign Up</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><i class="fas fa-phone"></i> (123) 456-7890</li>
                        <li><i class="fas fa-envelope"></i> info@dineeasy.com</li>
                        <li><i class="fas fa-map-marker"></i> 123 Restaurant St</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 DineEasy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="main.js"></script>
    <script>
        function getCartTotal() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            return cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        }

        function renderCartItems() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartItemsContainer = document.getElementById('cartItems');
            
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
            
            const subtotal = getCartTotal();
            const tax = subtotal * 0.10;
            const delivery = 5.00;
            const total = subtotal + tax + delivery;
            
            document.getElementById('cartSubtotal').textContent = '$' + subtotal.toFixed(2);
            document.getElementById('cartTax').textContent = '$' + tax.toFixed(2);
            document.getElementById('cartTotal').textContent = '$' + total.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
            renderCartItems();
        });
    </script>
</body>
</html>