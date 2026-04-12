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

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5" style="max-width:500px;">
    <div class="card p-4 shadow">

        <h3>Edit Product</h3>

        <form method="POST">
            <input class="form-control mb-3" name="name" value="<?= $product['name'] ?>">
            <input class="form-control mb-3" name="price" value="<?= $product['price'] ?>">
            <button class="btn btn-warning">Update</button>
        </form>

    </div>
</div>

</body>

</html>