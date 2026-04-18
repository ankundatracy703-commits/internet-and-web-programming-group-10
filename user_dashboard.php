<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - DineEasy</title>
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
                    <a href="user_dashboard.php" class="btn btn-outline">My Account</a>
                    <a href="index.php" class="btn btn-primary">Logout</a>
                </div>
            </nav>
        </div>
    </header>

    <section class="dashboard">
        <div class="container">
            <div class="section-title">
                <h2>My Dashboard</h2>
                <p>Welcome back!</p>
            </div>

            <div class="stat-cards">
                <div class="stat-card">
                    <h3 id="totalOrders">0</h3>
                    <p>Total Orders</p>
                </div>
                <div class="stat-card">
                    <h3 id="totalSpent">$0</h3>
                    <p>Total Spent</p>
                </div>
                <div class="stat-card">
                    <h3 id="totalReservations">0</h3>
                    <p>Reservations</p>
                </div>
            </div>

            <div class="dashboard-grid">
                <div class="sidebar">
                    <div class="sidebar-menu">
                        <a href="#" class="active" onclick="showSection('orders')">My Orders</a>
                        <a href="#" onclick="showSection('reservations')">My Reservations</a>
                        <a href="#" onclick="showSection('profile')">Profile</a>
                        <a href="menu.php">Order Food</a>
                        <a href="reservation.php">Make Reservation</a>
                        <a href="index.php">Home</a>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div id="ordersSection">
                        <h3>My Orders</h3>
                        <div id="userOrders">
                            <div class="empty-state">
                                <div class="empty-state-icon">📦</div>
                                <p>No orders yet</p>
                                <a href="menu.php" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>

                    <div id="reservationsSection" style="display: none;">
                        <h3>My Reservations</h3>
                        <div id="userReservations">
                            <div class="empty-state">
                                <div class="empty-state-icon">📅</div>
                                <p>No reservations yet</p>
                                <a href="reservation.php" class="btn btn-primary">Book a Table</a>
                            </div>
                        </div>
                    </div>

                    <div id="profileSection" style="display: none;">
                        <h3>My Profile</h3>
                        <form id="profileForm" onsubmit="updateProfile(event)">
                            <div class="form-group">
                                <label for="profileName">Name</label>
                                <input type="text" id="profileName" name="name" value="John Doe">
                            </div>
                            <div class="form-group">
                                <label for="profileEmail">Email</label>
                                <input type="email" id="profileEmail" name="email" value="john@example.com" readonly>
                            </div>
                            <div class="form-group">
                                <label for="profilePhone">Phone</label>
                                <input type="tel" id="profilePhone" name="phone" value="(555) 123-4567">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" id="newPassword" name="new_password" placeholder="Leave blank to keep current">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2026 DineEasy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="main.js"></script>
    <script>
        function showSection(sectionName) {
            const sections = ['orders', 'reservations', 'profile'];
            sections.forEach(s => {
                document.getElementById(s + 'Section').style.display = 'none';
            });
            document.getElementById(sectionName + 'Section').style.display = 'block';
        }

        function updateProfile(event) {
            event.preventDefault();
            showToast('Profile updated successfully!');
        }

        function loadUserData() {
            const currentUser = JSON.parse(localStorage.getItem('currentUser')) || { name: 'Guest' };
            
            document.getElementById('profileName').value = currentUser.name || 'John Doe';
            document.getElementById('profileEmail').value = currentUser.email || 'user@example.com';
            document.getElementById('profilePhone').value = currentUser.phone || '(555) 123-4567';
            
            document.getElementById('totalOrders').textContent = '3';
            document.getElementById('totalSpent').textContent = '$127.95';
            document.getElementById('totalReservations').textContent = '1';
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartDisplay();
            loadUserData();
        });
    </script>
</body>
</html>