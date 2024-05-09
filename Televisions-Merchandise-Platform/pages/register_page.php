<?php 
$pageTitle = "TV Shop - Register";
include '../includes/header.php'; 
?>

<script src="../scripts/script.js"></script>
<main>
    <section class="registerform">
        <h1>Register</h1>
        <form id="registrationForm" action="../server/register.php" method="POST">
            <div class="form-field">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <span class="error-message" id="username-error"></span>
            </div>
            <div class="form-field">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span class="error-message" id="email-error"></span>
            </div>
            <div class="form-field">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="error-message" id="password-error"></span>
            </div>
            <div class="form-field">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <span class="error-message" id="confirm-password-error"></span>
            </div>
            <div class="form-field">
                <button type="submit">Register</button>
            </div>
        </form>
        <h5>By registering an account, you agree to TV Shop's Conditions of Use and Privacy Notice.</h5>
    </section>
</main>
<?php include '../includes/footer.php'; ?> 
</body>
</html>
