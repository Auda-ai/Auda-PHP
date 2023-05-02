<?php

$servername = "localhost";
$username ="root";
$password="";
$database="student_db";

//create connection
$connection = new mysqli($servername, $username, $password, $database);


$id="";
$fname="";
$lname="";
$email="";
$password="";

$errorMessage = "";
$successMessage= "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
//GET Method: show the data of the user

if(!isset($_GET["id"])){
    header("Location: /Users/index.php");
    exit;
}
$id = $_GET["id"];

//read the row of the selected user from database table
$sql = "SELECT * FROM users WHERE id=$id";
$result = $connection->query($sql);
$row= $result->fetch_assoc();

if(!$row) {
    header("Location: /Users/index.php");
    exit;
}

$fname=$row["fname"];
$lname=$row["lname"];
$email=$row["email"];
$password=sha1($row["password"]);

} else{
// POST Method: update the data of the user

$id = $_POST["id"];
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$email=$_POST["email"];
$password=sha1($_POST["password"]);

do {
    if(empty($fname) || empty($lname) || empty($email) || empty($password)){
        $errorMessage = "All the fields are required";
        break;
    }
    $sql = "UPDATE users  " . 
              "SET fname = '$fname', lname = '$lname', email = '$email', password = '$password' " . 
              "WHERE id = $id";

$result = $connection->query($sql);

if(!$result) {
    $errorMessage = "Invalid query: " . $connection->error;
    break;
}
$successMessage = "User updated correctly";

header("Location: /Users/index.php");
exit;

} while(true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My workspace</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
<h2>New user</h2>

<?php
if(!empty($errorMessage)){
    echo "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>$errorMessage</strong>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>
    ";
}
?>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="row mb-3">
    <label class="col-sm-3 col-form-label">First name</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Last name</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-6">
        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
    </div>
</div>
<div class="row mb-3">
    <label class="col-sm-3 col-form-label">Password</label>
    <div class="col-sm-6">
        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>">
    </div>
</div>

 <?php
 if(!empty($successMessage)){
   echo "
   <div class='row mb-3'>
   <div class='offset-sm-3 col-sm-6'>
   <div class='alert alert-primary alert-dismissible fade show' role='alert'>
   <strong>$successMessage</strong>
   <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
 </div>
   </div>
   </div>
   ";
 }
 ?>

<div class="row mb-3">
    <div class="offset-sm-3 col-sm-3 d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div class="col-sm-3 d-grid">
        <a class="btn btn-outline-primary" href="/Users/index.php" role="button">Cancel</a>
    </div>
</div>
</form>
    </div>
</body>
</html>