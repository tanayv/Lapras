<?php
    
    /*
        Name: signUpScript.php
        Function: Obtains name, email, customerID and password as parameters and pushes them into the database.
    */
    
    include 'engine/connection.php';
    
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $customerID = $_POST['custID'];
    $password = $_POST['pass1'];
    
    //$query1 = mysqli_query($connection, "SELECT * FROM userData");
    
    mysqli_query($connection, "INSERT INTO userData (name, email, customerID, password) VALUES ('$fullName', '$email', '$customerID', '$password')");
    session_start();
    $_SESSION['customerID'] = $customerID;
    echo "<script type = 'text/javascript'>window.location.assign('index.php');</script>";

?>