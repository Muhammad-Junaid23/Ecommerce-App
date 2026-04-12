<?php 

require 'config.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    // hashing password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // registering user
    $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    $stmt-> execute([$name,$email,$password]);

     header("Location: index.php");
       exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
    <title>Register</title>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width:400px;">
    <div class="card p-4 shadow">

        <h3 class="mb-3 text-center">Register</h3>

        <form method="POST">
            <input class="form-control mb-3" name="name" placeholder="Name" required>
            <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="Password" required>
            <button class="btn btn-success w-100">Register</button>
        </form>

        <p class="mt-3 text-center">
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </div>
</div>

</body>
</html>