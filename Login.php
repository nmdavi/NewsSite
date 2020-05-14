<?php
require_once 'Source/Layout/part1.php';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/layout.css">';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/login_register.css">';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/login.css">';
require_once 'Source/Layout/part2.php';
?>

<div class="behind" onmousemove="closeMenu()">
    <section class="login-form">
        <div class="top-name">
            Login
        </div>
        <form action="Login.php" method="POST" class="login-main">
            <div class="form-list">
                <div class="form-email-pass">
                    <label for="email" class="label">Email</label><br>
                    <input type="email" name="email" class="form-input" placeholder="jonh@doe.com" required>
                    <br>
                    <label for="password" class="label">Password</label><br>
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                    <p class="forgot-pass"><a href="#" class="have-link">Forgot your password?</a></p>
                </div>
            </div>
            <div class="form-submit">
                <button type="submit" class="button-submit">Login</button>
                <p class="have">Do you not have an account? <a href="Register.php" class="have-link">Register</a></p>
            </div>
        </form>

    </section>
</div>

<?php require_once 'Source/Layout/part3.php'; ?>