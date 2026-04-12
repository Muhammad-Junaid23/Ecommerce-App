<?php 
require 'config.php';

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $name =$_POST['name'];
    $price =$_POST['price'];

    // add products into db
    $stmt = $pdo->prepare("INSERT INTO products (name,price) VALUES (?,?)");
    $stmt->execute([$name,$price]);

      header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5" style="max-width:500px;">
    <div class="card p-4 shadow">

        <h3>Add Product</h3>

        <form method="POST">
            <input class="form-control mb-3" name="name" placeholder="Product Name" required>
            <input class="form-control mb-3" name="price" placeholder="Price" required>
            <button class="btn btn-primary">Add</button>
        </form>

    </div>
</div>

</body>

</html>