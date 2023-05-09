<?php


$conn = new mysqli('localhost','root','','student_db');
if(!$conn){
    die(mysqli_error($conn));
}
?>