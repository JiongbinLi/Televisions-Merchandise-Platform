<?php 
session_start(); 

$pageTitle = "TV Shop - Home";
include '../includes/header.php'; 

require_once '../server/db_connect.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<?php
// Handle price filtering
$minPrice = isset($_GET['min_price']) ? (float)$_GET['min_price'] : 0;
$maxPrice = isset($_GET['max_price']) ? (float)$_GET['max_price'] : PHP_INT_MAX;
$searchInput = isset($_GET['searchInput']) ? $_GET['searchInput'] : '';

$sql = "SELECT * FROM products WHERE price >= ? AND price <= ? AND name LIKE ?";
$searchTerm = "%" . $searchInput . "%";
$stmt = $conn->prepare($sql);
$stmt->bind_param("dds", $minPrice, $maxPrice, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>


<main>
    <form id="filter_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">
            <label for="min_price">Minimum Price:</label>
            <input type="number" id="min_price" name="min_price" min="0" default="0" placeholder="Please enter a min price" value="<?php echo isset($_GET['min_price']) ? $_GET['min_price'] : ''; ?>">
            <br>
            <label for="max_price">Maximum Price:</label>
            <input type="number" id="max_price" name="max_price" min="0" placeholder="Please enter a max price" value="<?php echo isset($_GET['max_price']) ? $_GET['max_price'] : ''; ?>">
            <br>
            <label for="brand_or_model">Brand or Model:</label>
            <input type="text" id="searchInput" name="searchInput" placeholder="Search TVs..." value="<?php echo htmlspecialchars($searchInput); ?>">
            <br>
            <button type="submit">Filter</button>
    </form>
    <section class="product-list">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <article class="product" id="product<?php echo $row['id']; ?>">
                    <img src="<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['alt_text']); ?>">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p>Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                    <a href="product_detail.php?id=<?php echo $row['id']; ?>" class="add_to_cart_button">Add to Cart</a>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </section>
</main>

<?php include '../includes/footer.php'; ?>
<?php $conn->close(); ?>
