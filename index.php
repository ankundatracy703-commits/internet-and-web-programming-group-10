<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DineEasy - Restaurant Management System</title>
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

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Dine Easy</h1>
            <p>Experience culinary excellence from the comfort of your home</p>
            <div class="hero-buttons">
                <a href="menu.php" class="btn btn-primary">View Menu</a>
                <a href="reservation.php" class="btn btn-outline" style="border-color: white; color: white;">Book a Table</a>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose DineEasy?</h2>
                <p>We bring the restaurant experience to you with different types of meals local foods and international</p>
            </div>
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">🍽️</div>
                    <h3>Delicious Menu</h3>
                    <p>Browse our extensive menu featuring cuisines from around the world</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🚚🍲</div>
                    <h3>Fast Delivery</h3>
                    <p>Quick and reliable delivery to your doorstep</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3>Easy Reservations</h3>
                    <p>Book your table online in just a few clicks</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⭐</div>
                    <h3>Quality Service</h3>
                    <p>Our staff is dedicated to providing excellent service at affordable prices</p>
                </div>
            </div>
        </div>
    </section>

    <section class="menu-section">
        <div class="container">
            <div class="section-title">
                <h2>Featured Dishes</h2>
                <p>Discover our most popular items</p>
            </div>
            <div class="menu-grid">
                <div class="menu-item" data-category="1">
                    <div class="menu-image">🍥</div>
                    <div class="menu-info">
                        <h3>Bruschetta</h3>
                        <p>Toasted bread with fresh tomatoes and basil</p>
                        <div class="menu-price">
                            <span class="price">Ugs 10,000</span>
                            <button class="add-to-cart" onclick="addToCart(1, 'Bruschetta', 8.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="menu-item" data-category="1">
                    <div class="menu-image">🍗</div>
                    <div class="menu-info">
                        <h3>Chicken Wings</h3>
                        <p>Crispy fried wings with choice of sauce</p>
                        <div class="menu-price">
                            <span class="price">Ugs 18,000</span>
                            <button class="add-to-cart" onclick="addToCart(2, 'Chicken Wings', 12.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="menu-item" data-category="1">
                    <div class="menu-image">🥣</div>
                    <div class="menu-info">
                        <h3>Soup of the Day</h3>
                        <p>Ask your server for today's selection</p>
                        <div class="menu-price">
                            <span class="price">Ugs 12,000</span>
                            <button class="add-to-cart" onclick="addToCart(3, 'Soup of the Day', 6.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="menu-item" data-category="2">
                    <div class="menu-image">🐟</div>
                    <div class="menu-info">
                        <h3>Grilled Salmon</h3>
                        <p>Fresh salmon with herbs and lemon butter</p>
                        <div class="menu-price">
                            <span class="price">Ugs 200,000</span>
                            <button class="add-to-cart" onclick="addToCart(4, 'Grilled Salmon', 24.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="menu-item" data-category="2">
                    <div class="menu-image">🥩</div>
                    <div class="menu-info">
                        <h3>Beef Steak</h3>
                        <p>Juicy steak cooked to your preference</p>
                        <div class="menu-price">
                            <span class="price">augs 300,000</span>
                            <button class="add-to-cart" onclick="addToCart(5, 'Beef Steak', 29.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="menu-item" data-category="2">
                    <div class="menu-image">🍝</div>
                    <div class="menu-info">
                        <h3>Chicken Parmesan</h3>
                        <p>Breaded chicken with marinara and cheese</p>
                        <div class="menu-price">
                            <span class="price">Ugs29,000</span>
                            <button class="add-to-cart" onclick="addToCart(6, 'Chicken Parmesan', 18.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="menu-item" data-category="2">
                    <div class="menu-image">🍜</div>
                    <div class="menu-info">
                        <h3>Pasta Primavera</h3>
                        <p>Fresh vegetables with garlic olive oil</p>
                        <div class="menu-price">
                            <span class="price">Ugs 50,000</span>
                            <button class="add-to-cart" onclick="addToCart(7, 'Pasta Primavera', 16.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="menu-item" data-category="2">
                    <div class="menu-image">🐠</div>
                    <div class="menu-info">
                        <h3>Fish and Chips</h3>
                        <p>Crispy battered fish with fries</p>
                        <div class="menu-price">
                            <span class="price">Ufa 60,000</span>
                            <button class="add-to-cart" onclick="addToCart(8, 'Fish and Chips', 17.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 2rem;">
                <a href="menu.php" class="btn btn-primary">View Full Menu</a>
            </div>
        </div>
    </section>

    <section class="reservation-section" style="background: var(--light);">
        <div class="container">
            <div class="section-title">
                <h2>Make a Reservation</h2>
                <p>Book your table for a special dining experience</p>
            </div>
            <form class="reservation-form" action="api/reservation.php" method="POST" onsubmit="handleReservationForm(event)">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="date">Reservation Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Reservation Time</label>
                    <input type="time" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="guests">Number of Guests</label>
                    <select id="guests" name="guests">
                        <option value="1">1 Person</option>
                        <option value="2">2 People</option>
                        <option value="3">3 People</option>
                        <option value="4">4 People</option>
                        <option value="5">5 People</option>
                        <option value="6">6 People</option>
                        <option value="7">7+ People</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Book Table</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3>DineEasy</h3>
                    <p>Your favorite restaurant, now just a click away. Order online or book a table anytime.</p>
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
                        <li><i class="fas fa-map-marker"></i> 123 Restaurant St, Food City</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
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
        function handleLogin(response) {
            if (response.success) {
                if (response.role === 'admin') {
                    window.location.href = 'admin_dashboard.php';
                } else {
                    window.location.href = 'user_dashboard.php';
                }
            }
        }
    </script>
</body>
</html>