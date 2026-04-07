<?php 
require 'config.php';

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $name =$_POST['name'];
    $price =$_POST['price'];

    // add products into db
    $stmt = $pdo->prepare("INSERT INTO products (name,price) VALUES (?,?)");
    $stmt->execute([$name,$price]);

    echo "Product Added!";
}
?>

<form method="POST">
    <input name="name" placeholder="Product Name" required><br>
    <input name="price" placeholder="Price" required><br>
    <button>Add Product</button>
</form>