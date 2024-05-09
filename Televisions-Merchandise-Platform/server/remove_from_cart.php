<?php
session_start();

require_once 'db_connect.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // delete items from database
    $sql = "DELETE FROM cart_items WHERE product_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $product_id, $user_id);
    $stmt->execute();
    
    // Check if update is successful
    if ($stmt->affected_rows > 0) {
        echo "Product removed from cart.";
    } else {
        echo "Failed to remove product from cart.";
    }
}
header('Location: ../pages/shopping_cart.php');
exit();
?>
