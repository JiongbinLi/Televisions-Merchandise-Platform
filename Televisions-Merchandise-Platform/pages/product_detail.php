<?php
session_start();

$pageTitle = "TV Shop - Product Details";
include '../includes/header.php'; 

require_once '../server/db_connect.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        ?>
        <!-- Display product details -->
        <div class="product-detail">
            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
            
            <!-- Form for adding product to cart -->
            <form action="../server/add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1" style="width: 60px;">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
        <?php
    } else {
        echo "<p>Product not found.</p>";
    }
} else {
    echo "<p>No product ID specified.</p>";
}

$stmt->close();
$conn->close();
?>
<?php include '../includes/footer.php'; ?>
