<?php 
session_start(); 

$pageTitle = "TV Shop - Shopping Cart";
include '../includes/header.php'; 

require_once '../server/db_connect.php'; 

echo "<h2>Shopping Cart</h2>";

if (!isset($_SESSION['user_id'])) {
    echo "<p>Please <a href='login_page.php'>login</a> to view your shopping cart.</p>";
} else {
    $userId = $_SESSION['user_id'];

    // Get shopping cart items from database
    $sql = "SELECT products.id, products.name, products.price, cart_items.quantity 
            FROM cart_items 
            JOIN products ON cart_items.product_id = products.id 
            WHERE cart_items.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $total = 0;
        echo "<table>";
        echo "<tr><th>Product</th><th>Quantity</th><th>Price</th><th>Total</th><th>Update</th><th>Remove</th></tr>";

        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $productId = $row['id'];
            $itemTotal = $price * $quantity;
            $total += $itemTotal;

            echo "<tr>";
            echo "<td>" . htmlspecialchars($name) . "</td>";
            // Update quantity form
            echo "<form action='../server/update_cart.php' method='post'>";
            echo "<td><input type='number' name='quantity' value='" . htmlspecialchars($quantity) . "' min='1' style='width: 60px;'></td>";
            echo "<input type='hidden' name='product_id' value='" . $productId . "'>";
            echo "<td>$" . number_format($price, 2) . "</td>";
            echo "<td>$" . number_format($itemTotal, 2) . "</td>";
            echo "<td><button type='submit'>Update</button></td>";
            echo "</form>";
            // Remove product form
            echo "<form action='../server/remove_from_cart.php' method='post'>";
            echo "<input type='hidden' name='product_id' value='" . $productId . "'>";
            echo "<td><button type='submit' name='remove'>Remove</button></td>";
            echo "</form>";
            echo "</tr>";
        }

        echo "<tr><td colspan='4'>Total</td><td>$" . number_format($total, 2) . "</td></tr>";
        echo "</table>";
    } else {
        echo "<p>Your shopping cart is empty.</p>";
    }
}

$conn->close();
include '../includes/footer.php'; 
?>
