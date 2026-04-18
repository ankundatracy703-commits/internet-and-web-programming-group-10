<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - DineEasy</title>
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
            <h2>Create Account</h2>
            
            <form id="registerForm" onsubmit="handleRegisterForm(event)">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Sign Up</button>
            </form>
            
            <p>Already have an account? <a href="login.php" style="color: var(--primary);">Login</a></p>
        </div>
    </div>

    <script src="main.js"></script>
    <script>
        function handleRegisterForm(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            
            const name = formData.get('name');
            const email = formData.get('email');
            const phone = formData.get('phone');
            const password = formData.get('password');
            const confirmPassword = formData.get('confirm_password');
            
            if (password !== confirmPassword) {
                showToast('Passwords do not match');
                return;
            }
            
            if (password.length < 6) {
                showToast('Password must be at least 6 characters');
                return;
            }
            
            const mockUsers = JSON.parse(localStorage.getItem('users')) || [];
            
            if (mockUsers.find(u => u.email === email)) {
                showToast('Email already registered');
                return;
            }
            
            const newUser = {
                id: Date.now(),
                name: name,
                email: email,
                phone: phone,
                password: password,
                role: 'user'
            };
            
            mockUsers.push(newUser);
            localStorage.setItem('users', JSON.stringify(mockUsers));
            
            showToast('Registration successful! Please login.');
            setTimeout(() => window.location.href = 'login.php', 1500);
        }
    </script>
</body>
</html>