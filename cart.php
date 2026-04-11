<?php
session_start();
require 'config.php';

if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
    // $_SESSION['cart'][$id] = quantity;
}

// add product to cart
if(isset($_POST['product_id'])){
    $_SESSION['cart'][]=$_POST['product_id'];
}


$cartItems =[];

if (empty($cartItems)) {
    echo "Your cart is empty";
}

if(!empty($_SESSION['cart'])){
    $ids = implode(",",$_SESSION['cart']);
    // fetch products from DB with ids
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $cartItems = $stmt->fetchAll();
}

// increment cart item
if (isset($_POST['product_id'])) {
    $id = $_POST['product_id'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++; // increment
    } else {
        $_SESSION['cart'][$id] = 1; // new item
    }
}

// decrement cart item
if (isset($_POST['decrease_id'])) {
    $id = $_POST['decrease_id'];

    if ($_SESSION['cart'][$id] > 1) {
        $_SESSION['cart'][$id]--;
    } else {
        unset($_SESSION['cart'][$id]);
    }
}

// remove item
if (isset($_POST['remove_id'])) {
    $id = $_POST['remove_id'];
    unset($_SESSION['cart'][$id]);
}

?>

<h2>Your Cart</h2>

<?php foreach ($cartItems as $item): ?>
    <div>
        <h4><?= $item['name'] ?></h4>
        <p>Rs <?= $item['price'] ?></p>

        <form method="POST">
    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
    <button>+</button>
</form>

<form method="POST">
    <input type="hidden" name="decrease_id" value="<?= $item['id'] ?>">
    <button>-</button>
</form>

<form method="POST">
    <input type="hidden" name="remove_id" value="<?= $item['id'] ?>">
    <button>Remove</button>
</form>

<p>Quantity: <?= $_SESSION['cart'][$item['id']] ?></p>
    </div>
<?php endforeach; ?>