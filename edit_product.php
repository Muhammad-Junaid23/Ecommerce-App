<?php
require 'config.php';

$id = $_GET['id'];

// fetch product where id
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $price = $_POST['price'];

    // updating product
    $stmt = $pdo->prepare("UPDATE products SET name=?, price=? WHERE id=?");
    $stmt->execute([$name,$price,$id]);

    header("Location: index.php");
}
?>

<form method="POST">
    <input name="name" value="<?= $product['name'] ?>"><br>
    <input name="price" value="<?= $product['price'] ?>"><br>
    <button>Update</button>
</form>