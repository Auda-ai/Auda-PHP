<?php
include 'connection.php';

//create connection



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email=$_POST["email"];
    $password=sha1($_POST["password"]);

 
        $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
        
        if(!$result) {
            echo "Error :" .$mysqli->error;
            exit();
        }
if($result) {
    // header("Location:index.php");
    session_start();
    $_SESSION["email"]=$email;
    header("Location: /Users/index.php");
    exit();
    
}else{
    header("Location: /Users/index.php");
    exit();
}


    } 



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <form method="POST">
    <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-6">
        <input type="email" class="form-control" name="email">
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-6">
        <input type="password" class="form-control" name="password">
    </div>
</div>
<div class="offset-sm-3 col-sm-3 d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
    </form>
</body>
</html>