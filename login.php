<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - DineEasy</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="all.min.css">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline';">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
</head>
<body>
    <div class="auth-page">
        <div class="auth-container">
            <h2>Welcome Back</h2>
            
            <form id="loginForm" onsubmit="handleLoginForm(event)">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
            
            <p>Don't have an account? <a href="register.php" style="color: var(--primary);">Sign Up</a></p>
            
            <div style="margin-top: 1.5rem; padding: 1rem; background: var(--light); border-radius: 8px; font-size: 0.9rem;">
                <strong>Demo Accounts:</strong><br>
                Admin: admin@dineeasy.com / admin123<br>
                User: user@dineeasy.com / user123
            </div>
        </div>
    </div>

    <script src="main.js"></script>
    <script>
        function handleLoginForm(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            
            const email = formData.get('email');
            const password = formData.get('password');
            
            if (email === 'admin@dineeasy.com' && password === 'admin123') {
                showToast('Login successful!');
                setTimeout(() => window.location.href = 'admin_dashboard.php', 1000);
            } else if (email === 'user@dineeasy.com' && password === 'user123') {
                showToast('Login successful!');
                setTimeout(() => window.location.href = 'user_dashboard.php', 1000);
            } else {
                const mockUsers = JSON.parse(localStorage.getItem('users')) || [];
                const user = mockUsers.find(u => u.email === email && u.password === password);
                
                if (user) {
                    showToast('Login successful!');
                    localStorage.setItem('currentUser', JSON.stringify(user));
                    setTimeout(() => window.location.href = 'user_dashboard.php', 1000);
                } else {
                    showToast('Invalid email or password');
                }
            }
        }
    </script>
</body>
</html>