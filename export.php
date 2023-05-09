<?php
if(isset($_POST["export"])){
    include 'connection.php';
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');

    $output = fopen("php://output", "w");
    fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Password'));

    $query = "SELECT * FROM users ORDER BY id DESC";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        fputcsv($output, $row);
    }
    fclose($output);
}
?>