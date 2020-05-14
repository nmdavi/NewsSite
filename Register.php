<?php
require_once 'Source/Layout/part1.php';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/layout.css">';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/login_register.css">';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/register.css">';
require_once 'Source/Layout/part2.php';
?>

<div class="behind" onmousemove="closeMenu()">
    <section class="register-form">
        <div class="top-name">
            REGISTER
        </div>
        <form action="Register.php" method="POST" class="register-main">
            <div class="form-list">
                <div class="form-list-name">
                    <label for="first_name" class="label">First Name</label>
                    <input type="text" name="first_name" class="form-input form-input-name" placeholder="John" required>
                </div>
                <div class="form-list-name">
                    <label for="last_name" class="label">Last Name</label>
                    <input type="text" name="last_name" class="form-input form-input-name" placeholder="Doe" required>
                </div>

                <div class="form-email-pass">
                    <label for="email" class="label">Email</label><br>
                    <input type="email" name="email" class="form-input" placeholder="jonh@doe.com" required>
                    <br>
                    <label for="password" class="label">Password</label><br>
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                    <br>
                    <label for="password" class="label">Confirm Password</label><br>
                    <input type="password" name="password" class="form-input" placeholder="Confirm Password" required>
                </div>
                <div class="form-rules">
                    <input type="checkbox" name="rules">
                    <label>I agree to terms</label>
                </div>
            </div>
            <div class="form-submit">
                <button type="submit" class="button-submit">Register</button>
                <p class="have">Already have an account? <a href="#" class="have-link">Login</a></p>
            </div>
        </form>

    </section>
</div>

<?php require_once 'Source/Layout/part3.php'; ?>