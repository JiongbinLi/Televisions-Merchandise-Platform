<?php
$pageTitle = "TV Shop - Login";
include '../includes/header.php';
// If the user is already logged in, redirect to the homepage
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<main>
    <section class="registerform">
        <h2>Login</h2>
        <div id="login-container">
            <form action="../server/login.php" id="loginForm" method="POST" onsubmit="return validateLoginForm()">
                <div class="form-field">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username">
                    <span class="error-message" id="username-error"></span>
                </div>
                <div class="form-field">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password">
                    <span class="error-message" id="password-error"></span>
                </div>
                <div class="form-field">
                    <button type="submit" id="loginButton">Login</button>
                </div>
            </form>
            <p>Don't have an account? <a href="register_page.php">Register here</a>.</p>
        </div>
    </section>
</main>
<script>
    function validateLoginForm() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var valid = true;

        if(username.trim() === '') {
            document.getElementById('username-error').textContent = 'Username is required.';
            valid = false;
        } else {
            document.getElementById('username-error').textContent = '';
        }

        if(password.trim() === '') {
            document.getElementById('password-error').textContent = 'Password is required.';
            valid = false;
        } else {
            document.getElementById('password-error').textContent = '';
        }

        return valid; 
    }
</script>
<?php include '../includes/footer.php'; ?>
