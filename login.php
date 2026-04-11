<?php 
session_start();
require 'config.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'];

    // fetch the user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify password using hash
    if($user && password_verify($password,$user['password'])){
        $_SESSION['user_id']=$user['id'];
        $_SESSION['user_name']=$user['name'];
        
       header("Location: index.php");
       exit;
    }else{
        echo "Invalid Credentials!";
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>
