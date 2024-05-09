<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../scripts/script.js" defer></script>
</head>
<body>
    <header>
        <h1>Welcome to TV Shop</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shopping_cart.php">Shopping Cart</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="profile_page.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                    <li><a href="../server/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login_page.php">Login</a></li>
                    <li><a href="register_page.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
