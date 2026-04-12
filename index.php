<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    
    <nav class="navbar navbar-dark bg-dark px-4">
        <span class="navbar-brand">Ecommerce App</span>

    <div class="d-flex gap-2">
        <!-- <a href="index.php" class="btn btn-outline-light btn-sm">Products</a> -->
        <a href="add_product.php" class="btn btn-outline-light btn-sm">Add Product</a>
        <a href="cart.php" class="btn btn-outline-light btn-sm">Cart</a>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Welcome, <?= $_SESSION['user_name'] ?></h2>
        <!-- <div>
            <a href="cart.php" class="btn btn-success">Cart</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div> -->
    </div>

    <h3 class="mb-3">Products</h3>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">

                <div class="card h-100 shadow-sm p-3">

                    <h5><?= $product['name'] ?></h5>
                    <p class="text-muted"><?= $product['description'] ?></p>
                    <h6 class="text-primary">Rs <?= $product['price'] ?></h6>

                    <div class="mt-auto d-flex gap-2">

                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button class="btn btn-primary btn-sm">Add</button>
                        </form>

                        <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Edit</a>

                        <form method="POST" action="delete_product.php">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <button onclick="return confirm('Delete this product?')" class="btn btn-danger btn-sm">
    Delete
</button>
                        </form>

                    </div>

                </div>

            </div>
        <?php endforeach; ?>
    </div>

</div>
</body>

</html>