<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - DineEasy</title>
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

    <section class="menu-section">
        <div class="container">
            <div class="section-title">
                <h2>Our Menu</h2>
                <p>Delicious dishes crafted with passion</p>
            </div>

            <div class="menu-tabs">
                <button class="menu-tab active" onclick="filterMenu('all')">All</button>
                <button class="menu-tab" onclick="filterMenu('1')">Starters</button>
                <button class="menu-tab" onclick="filterMenu('2')">Main Courses</button>
                <button class="menu-tab" onclick="filterMenu('3')">Desserts</button>
                <button class="menu-tab" onclick="filterMenu('4')">Beverages</button>
            </div>

            <div style="margin-bottom: 2rem;">
                <input type="text" placeholder="Search menu..." 
                       style="padding: 0.75rem; width: 100%; max-width: 400px; border: 1px solid #ddd; border-radius: 8px;"
                       onkeyup="searchMenu(this.value)">
            </div>

            <div class="menu-grid">
                <div class="menu-item" data-category="1">
                    <div class="menu-image">🍴</div>
                    <div class="menu-info">
                        <h3>Bruschetta</h3>
                        <p>Toasted bread with fresh tomatoes and basil</p>
                        <div class="menu-price">
                            <span class="price">$8.99</span>
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
                            <span class="price">$12.99</span>
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
                            <span class="price">$6.99</span>
                            <button class="add-to-cart" onclick="addToCart(3, 'Soup of the Day', 6.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="1">
                    <div class="menu-image">🥗</div>
                    <div class="menu-info">
                        <h3>Caesar Salad</h3>
                        <p>Fresh romaine lettuce with classic dressing</p>
                        <div class="menu-price">
                            <span class="price">$10.99</span>
                            <button class="add-to-cart" onclick="addToCart(4, 'Caesar Salad', 10.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="2">
                    <div class="menu-image">🐟</div>
                    <div class="menu-info">
                        <h3>Grilled Salmon</h3>
                        <p>Fresh salmon with herbs and lemon butter</p>
                        <div class="menu-price">
                            <span class="price">$24.99</span>
                            <button class="add-to-cart" onclick="addToCart(5, 'Grilled Salmon', 24.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="2">
                    <div class="menu-image">🥩</div>
                    <div class="menu-info">
                        <h3>Beef Steak</h3>
                        <p>Juicy steak cooked to your preference</p>
                        <div class="menu-price">
                            <span class="price">$29.99</span>
                            <button class="add-to-cart" onclick="addToCart(6, 'Beef Steak', 29.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="2">
                    <div class="menu-image">🍝</div>
                    <div class="menu-info">
                        <h3>Chicken Parmesan</h3>
                        <p>Breaded chicken with marinara and cheese</p>
                        <div class="menu-price">
                            <span class="price">$18.99</span>
                            <button class="add-to-cart" onclick="addToCart(7, 'Chicken Parmesan', 18.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="2">
                    <div class="menu-image">🍜</div>
                    <div class="menu-info">
                        <h3>Pasta Primavera</h3>
                        <p>Fresh vegetables with garlic olive oil</p>
                        <div class="menu-price">
                            <span class="price">$16.99</span>
                            <button class="add-to-cart" onclick="addToCart(8, 'Pasta Primavera', 16.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="2">
                    <div class="menu-image">🐠</div>
                    <div class="menu-info">
                        <h3>Fish and Chips</h3>
                        <p>Crispy battered fish with fries</p>
                        <div class="menu-price">
                            <span class="price">$17.99</span>
                            <button class="add-to-cart" onclick="addToCart(9, 'Fish and Chips', 17.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="2">
                    <div class="menu-image">🍕</div>
                    <div class="menu-info">
                        <h3>Pizza Margherita</h3>
                        <p>Classic tomato, mozzarella, and basil</p>
                        <div class="menu-price">
                            <span class="price">$15.99</span>
                            <button class="add-to-cart" onclick="addToCart(10, 'Pizza Margherita', 15.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="3">
                    <div class="menu-image">🍰</div>
                    <div class="menu-info">
                        <h3>Chocolate Cake</h3>
                        <p>Rich chocolate ganache layered cake</p>
                        <div class="menu-price">
                            <span class="price">$8.99</span>
                            <button class="add-to-cart" onclick="addToCart(11, 'Chocolate Cake', 8.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="3">
                    <div class="menu-image">🍦</div>
                    <div class="menu-info">
                        <h3>Ice Cream Sundae</h3>
                        <p>Three scoops with toppings</p>
                        <div class="menu-price">
                            <span class="price">$7.99</span>
                            <button class="add-to-cart" onclick="addToCart(12, 'Ice Cream Sundae', 7.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="3">
                    <div class="menu-image">🥧</div>
                    <div class="menu-info">
                        <h3>Apple Pie</h3>
                        <p>Warm apple pie with vanilla ice cream</p>
                        <div class="menu-price">
                            <span class="price">$6.99</span>
                            <button class="add-to-cart" onclick="addToCart(13, 'Apple Pie', 6.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="4">
                    <div class="menu-image">🥤</div>
                    <div class="menu-info">
                        <h3>Fresh Lemonade</h3>
                        <p>Refreshing homemade lemonade</p>
                        <div class="menu-price">
                            <span class="price">$4.99</span>
                            <button class="add-to-cart" onclick="addToCart(14, 'Fresh Lemonade', 4.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="4">
                    <div class="menu-image">☕</div>
                    <div class="menu-info">
                        <h3>Coffee</h3>
                        <p>Freshly brewed coffee</p>
                        <div class="menu-price">
                            <span class="price">$3.99</span>
                            <button class="add-to-cart" onclick="addToCart(15, 'Coffee', 3.99)">Add to Cart</button>
                        </div>
                    </div>
                </div>

                <div class="menu-item" data-category="4">
                    <div class="menu-image">🍵</div>
                    <div class="menu-info">
                        <h3>Green Tea</h3>
                        <p>Premium green tea</p>
                        <div class="menu-price">
                            <span class="price">$3.49</span>
                            <button class="add-to-cart" onclick="addToCart(16, 'Green Tea', 3.49)">Add to Cart</button>
                        </div>
                    </div>
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
</body>
</html>