<?php
session_start();

require_once 'db_connect.php';

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $user_id = $_SESSION['user_id']; 

    // Update the quantity of items in the database
    $sql = "UPDATE cart_items SET quantity = ? WHERE product_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $product_id, $user_id);
    $stmt->execute();
    
    // Check if update is successful
    if ($stmt->affected_rows > 0) {
        echo "Cart updated successfully.";
    } else {
        echo "Failed to update cart.";
    }
}

header('Location: ../pages/shopping_cart.php');
exit();
?>
