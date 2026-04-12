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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width:400px;">
    <div class="card p-4 shadow">

        <h3 class="mb-3 text-center">Login</h3>

        <form method="POST">
            <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
            <button class="btn btn-primary w-100">Login</button>
        </form>

        <p class="mt-3 text-center">
            Don't have an account?
            <a href="register.php">Register</a>
        </p>

    </div>
</div>

</body>
</html>
