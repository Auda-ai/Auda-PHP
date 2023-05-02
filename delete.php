<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

$servername = "localhost";
$username ="root";
$password="";
$database="student_db";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$sql = "DELETE FROM users WHERE id=$id";
$connection->query($sql);

}

header("Location: /Users/index.php");
exit;

?>