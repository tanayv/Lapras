<?php
    
    include 'engine/connection.php';
    
    $email = $_POST['email'];
    $customerID = $_POST['custID'];
    $password = $_POst['pass1'];
    
    $query1 = mysqli_query($connection, "SELECT * FROM userData");
    
    mysqli_query($connection, "INSERT INTO userData (email, customerID, password) VALUES ($email, $customerID, $password)");
    echo "<script type = 'text/javascript'>window.location.assign('/');</script>";
?>