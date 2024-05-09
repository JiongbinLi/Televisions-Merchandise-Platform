document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('username').addEventListener('input', function() {
        var username = this.value.trim();
        var message = '';
        if (username.length === 0) {
            message = 'Username is required.';
        } else if (username.length < 5) {
            message = 'Username must be at least 5 characters long.';
        }
        document.getElementById('username-error').textContent = message;
    });

    document.getElementById('email').addEventListener('input', function() {
        var email = this.value.trim();
        var message = '';
        var emailPattern = /\S+@\S+\.\S+/;
        if (email.length === 0) {
            message = 'Email is required.';
        } else if (!emailPattern.test(email)) {
            message = 'Please enter a valid email address.';
        }
        document.getElementById('email-error').textContent = message;
    });

    document.getElementById('password').addEventListener('input', function() {
        var password = this.value.trim();
        var message = '';
        if (password.length === 0) {
            message = 'Password is required.';
        } else if (password.length < 8) {
            message = 'Password must be at least 8 characters long.';
        } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
            message = 'Password must contain at least one letter and one number.';
        }
        document.getElementById('password-error').textContent = message;
    });

    document.getElementById('confirm_password').addEventListener('input', function() {
        var confirmPassword = this.value.trim();
        var password = document.getElementById('password').value.trim();
        var message = '';
        if (confirmPassword !== password) {
            message = 'Passwords do not match.';
        }
        document.getElementById('confirm-password-error').textContent = message;
    });
});
