<?php
require 'config.php';

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
    </div>
<?php endforeach; ?>

</body>
</html>