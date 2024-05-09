<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: login_page.php');
    exit();
}

$pageTitle = "TV Shop - Profile";
include '../includes/header.php';
?>

<main>
    <h2>User Profile</h2>
    <div class="profile-info">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
