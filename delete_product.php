<?php 
require 'config.php';

$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");

?>