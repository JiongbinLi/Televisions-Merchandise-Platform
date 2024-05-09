<?php
session_start();
require 'db_connect.php'; 

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login_page.php');
    exit();
}

if (isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

    // Check if the item is already in the shopping cart
    $sql = "SELECT quantity FROM cart_items WHERE user_id = ? AND product_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ii", $userId, $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If the item is already in the shopping cart, increase the quantity
            $row = $result->fetch_assoc();
            $newQuantity = $row['quantity'] + $quantity;
            $updateSql = "UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?";
            if ($updateStmt = $conn->prepare($updateSql)) {
                $updateStmt->bind_param("iii", $newQuantity, $userId, $productId);
                $updateStmt->execute();
                $updateStmt->close();
            }
        } else {
            // Otherwise, add new items to cart
            $insertSql = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)";
            if ($insertStmt = $conn->prepare($insertSql)) {
                $insertStmt->bind_param("iii", $userId, $productId, $quantity);
                $insertStmt->execute();
                $insertStmt->close();
            }
        }
        $stmt->close();
    }
    header('Location: ../pages/shopping_cart.php');
    exit();
} else {
    // If there is no product ID, redirect back to homepage
    header('Location: ../pages/index.php');
    exit();
}
?>
