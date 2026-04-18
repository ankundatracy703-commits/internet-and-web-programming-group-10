<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DineEasy</title>
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
                    <span style="margin-right: 1rem;">Admin Panel</span>
                    <a href="index.php" class="btn btn-outline">Logout</a>
                </div>
            </nav>
        </div>
    </header>

    <section class="dashboard">
        <div class="container">
            <div class="section-title">
                <h2>Admin Dashboard</h2>
                <p>Manage your restaurant</p>
            </div>

            <div class="dashboard-grid">
                <div class="sidebar">
                    <div class="sidebar-menu">
                        <a href="#" class="active" onclick="showSection('orders')">Orders</a>
                        <a href="#" onclick="showSection('reservations')">Reservations</a>
                        <a href="#" onclick="showSection('menu')">Menu Items</a>
                        <a href="#" onclick="showSection('customers')">Customers</a>
                        <a href="index.php">Back to Home</a>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div id="ordersSection">
                        <h3>Recent Orders</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="ordersTable">
                                <tr>
                                    <td>#1001</td>
                                    <td>John Doe</td>
                                    <td>2 items</td>
                                    <td>$45.98</td>
                                    <td><span class="status-badge status-preparing">Preparing</span></td>
                                    <td>
                                        <button class="btn btn-success" onclick="updateOrderStatus(1001, 'ready')">Ready</button>
                                        <button class="btn btn-danger" onclick="updateOrderStatus(1001, 'cancelled')">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1002</td>
                                    <td>Jane Smith</td>
                                    <td>3 items</td>
                                    <td>$62.97</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn btn-success" onclick="updateOrderStatus(1002, 'preparing')">Prepare</button>
                                        <button class="btn btn-danger" onclick="updateOrderStatus(1002, 'cancelled')">Cancel</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1003</td>
                                    <td>Mike Johnson</td>
                                    <td>1 item</td>
                                    <td>$24.99</td>
                                    <td><span class="status-badge status-ready">Ready</span></td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updateOrderStatus(1003, 'completed')">Complete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="reservationsSection" style="display: none;">
                        <h3>Table Reservations</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Guests</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="reservationsTable">
                                <tr>
                                    <td>#1</td>
                                    <td>Alice Brown</td>
                                    <td>(555) 123-4567</td>
                                    <td>2026-04-20</td>
                                    <td>7:00 PM</td>
                                    <td>4</td>
                                    <td><span class="status-badge status-confirmed">Confirmed</span></td>
                                </tr>
                                <tr>
                                    <td>#2</td>
                                    <td>Bob Wilson</td>
                                    <td>(555) 987-6543</td>
                                    <td>2026-04-21</td>
                                    <td>6:30 PM</td>
                                    <td>2</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="menuSection" style="display: none;">
                        <h3>Menu Management</h3>
                        <div style="margin-bottom: 1rem;">
                            <button class="btn btn-primary" onclick="alert('Add menu item modal would open here')">Add New Item</button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Bruschetta</td>
                                    <td>Starters</td>
                                    <td>$8.99</td>
                                    <td>
                                        <button class="btn btn-outline">Edit</button>
                                        <button class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Grilled Salmon</td>
                                    <td>Main Courses</td>
                                    <td>$24.99</td>
                                    <td>
                                        <button class="btn btn-outline">Edit</button>
                                        <button class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="customersSection" style="display: none;">
                        <h3>Customer List</h3>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>john@example.com</td>
                                    <td>(555) 111-2222</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>jane@example.com</td>
                                    <td>(555) 333-4444</td>
                                    <td>3</td>
                                </tr>
                            </tbody>
                        </table>
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
            const sections = ['orders', 'reservations', 'menu', 'customers'];
            sections.forEach(s => {
                document.getElementById(s + 'Section').style.display = 'none';
            });
            document.getElementById(sectionName + 'Section').style.display = 'block';
        }

        function updateOrderStatus(orderId, status) {
            showToast('Order #' + orderId + ' status updated to: ' + status);
        }
    </script>
</body>
</html>