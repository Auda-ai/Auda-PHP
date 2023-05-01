<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
<!-- <h2>LIST OF USERS</h2> -->
<a class="btn btn-primary" href="/Users/create.php" role="button">Add user</a><br>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
    </thead>
    <tbody>

<?php

$servername="localhost";
$username="root";
$password="";
$database="student_db";
//create connection
$conn=new mysqli($servername,$username,$password,$database);
//check connection
if($conn->connect_error){
    die("connection failed" . $conn->connect_error);
}
echo "connected successfuly";

//read all rows from database table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Invlid query: " . $conn->error);
}

while($row = $result->fetch_assoc()){
    echo "
    <tr>
    <td>$row[id]</td>
    <td>$row[fname]</td>
    <td>$row[lname]</td>
    <td>$row[email]</td>
    <td>$row[password]</td>
    <td>
       <a class='btn btn-primary btn-sm' href='/Users/edit.php?id=$row[id]'>Edit</a>
       <a class='btn btn-danger btn-sm' href='/Users/delete.php?id=$row[id]'>Delete</a>
    </td>
</tr>
    ";
}

?>
    </tbody>
</table>
    </div>
</body>
</html>