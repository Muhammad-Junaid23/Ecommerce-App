<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please login first";
    exit;
}

// Fetch products
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h1>Product List</h1>

<?php foreach ($products as $product): ?>
    <div style="border:1px solid #000; margin:10px; padding:10px;">
        <h3><?= $product['name'] ?></h3>
        <p><?= $product['description'] ?></p>
        <strong>Price: Rs <?= $product['price'] ?></strong>

    <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <button>Add to Cart</button>
    </form>

        <a href="edit_product.php?id=<?= $product['id'] ?>">Edit</a>

    <form method="POST" action="delete_product.php">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <button>Delete</button>
    </form>
    </div>
<?php endforeach; ?>

</body>
</html>