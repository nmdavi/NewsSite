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
            Recover your account
        </div>
        <?php if (true) : ?>
        <form action="ForgotPassword.php" method="POST" class="login-main">
            <p class="message-recover">
                Enter your email and we will send you a link to recover your account.
            </p>
            <div class="form-list">
                <div class="form-email-pass">
                    <label for="email" class="label">Email</label><br>
                    <input type="email" name="email" class="form-input" placeholder="jonh@doe.com" required>

                </div>
            </div>
            <div class="form-submit">
                <button type="submit" class="button-submit">Send link</button>
            </div>
        </form>
        <?php else : ?>
        <form action="ForgotPassword.php" method="POST" class="login-main">
            <div class="form-list">
                <div class="form-email-pass">
                    <label for="password" class="label">New Password</label><br>
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                    <br>
                    <label for="password" class="label">Confirm Password</label><br>
                    <input type="password" name="password" class="form-input" placeholder="Confirm Password" required>
                </div>
            </div>
            <div class="form-submit">
                <button type="submit" class="button-submit">Confirm</button>
            </div>
        </form>
        <?php endif; ?>
    </section>
</div>

<?php require_once 'Source/Layout/part3.php'; ?>