<?php

    include 'engine/connection.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query1 = mysqli_query($connection, "SELECT * FROM userData WHERE email = '$email'");
    
    while ($row = mysqli_fetch_array($query1)) {
            $passCorrect = $row['password'];
            $customerID = $row['customerID'];
    }
    
    if (strcmp($password, $passCorrect)==0) {
        session_start();
        $_SESSION['customerID'] = $customerID;
        echo "<script type = 'text/javascript'>window.location.assign('/');</script>";
    }
    else
        echo "<script type = 'text/javascript'>window.location.assign('/?error=1');</script>";
    
?>