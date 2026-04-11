<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "Please login first";
    exit;
}

echo "Welcome, " . $_SESSION['user_name'];

// Fetch products
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
<h1>Product List</h1>

<?php foreach ($products as $product): ?>
    <div style="border:1px solid #000; margin:10px; padding:10px;">
        <div class="card mb-3 p-3">
    <h5><?= $product['name'] ?></h5>
    <p><?= $product['description'] ?></p>
    <strong>Rs <?= $product['price'] ?></strong>
</div>

    <form method="POST" action="cart.php">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
       <button class="btn btn-primary">Add to Cart</button>
    </form>

        <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-warning">Edit</a>

    <form method="POST" action="delete_product.php">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <button class="btn btn-danger">Delete</button>
    </form>
    </div>
<?php endforeach; ?>

<a href="logout.php" class="btn btn-secondary">Logout</a>

</div>
</body>
</html>