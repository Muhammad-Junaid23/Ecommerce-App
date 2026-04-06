<?php
session_start();
require 'config.php';

if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=[];
}

// add product to cart
if(isset($_POST['product_id'])){
    $_SESSION['cart'][]=$_POST['product_id'];
}

// fetch products from DB

$cartItems =[];

if(!empty($_SESSION['cart'])){
    $ids = implode(",",$_SESSION['cart']);
    $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
    $cartItems = $stmt->fetchAll();
}
?>

<h2>Your Cart</h2>

<?php foreach ($cartItems as $item): ?>
    <div>
        <h4><?= $item['name'] ?></h4>
        <p>Rs <?= $item['price'] ?></p>
    </div>
<?php endforeach; ?>