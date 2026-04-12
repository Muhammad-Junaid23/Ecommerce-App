<?php
session_start();
require 'config.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ADD / INCREMENT
if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

// DECREMENT
if (isset($_POST['decrease_id'])) {
    $id = $_POST['decrease_id'];

    if ($_SESSION['cart'][$id] > 1) {
        $_SESSION['cart'][$id]--;
    } else {
        unset($_SESSION['cart'][$id]);
    }
}

// REMOVE
if (isset($_POST['remove_id'])) {
    $id = $_POST['remove_id'];
    unset($_SESSION['cart'][$id]);
}

// FETCH PRODUCTS
$cartItems = [];

if (!empty($_SESSION['cart'])) {
    $ids = implode(",", array_keys($_SESSION['cart']));
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $cartItems = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<h2>Your Cart</h2>

<?php if (empty($cartItems)): ?>
    <div class="alert alert-info">Your cart is empty</div>
<?php endif; ?>

<?php foreach ($cartItems as $item): ?>
    <div class="card mb-3 p-3 d-flex flex-row justify-content-between align-items-center">

        <div>
            <h5><?= $item['name'] ?></h5>
            <p>Rs <?= $item['price'] ?></p>
            <p><strong>Qty: <?= $_SESSION['cart'][$item['id']] ?></strong></p>
        </div>

        <div class="d-flex gap-2">

            <form method="POST">
                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                <button class="btn btn-success">+</button>
            </form>

            <form method="POST">
                <input type="hidden" name="decrease_id" value="<?= $item['id'] ?>">
                <button class="btn btn-warning">-</button>
            </form>

            <form method="POST">
                <input type="hidden" name="remove_id" value="<?= $item['id'] ?>">
                <button class="btn btn-danger">Remove</button>
            </form>

        </div>

    </div>
<?php endforeach; ?>

<a href="index.php" class="btn btn-primary">Back to Products</a>

</div>
</body>
</html>