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
    
    //Set Default Account ID
    $url = 'http://api.reimaginebanking.com/customers/' . $customerID . '/accounts?key=e567da9aeeb79795c54bf9af975f856e';
    $xml = file_get_contents($url);
    $arrCustAccs = json_decode($xml, true);
    $accountID = $arrCustAccs[0]['_id'];
    
    
    //$query1 = mysqli_query($connection, "SELECT * FROM userData");
    
    mysqli_query($connection, "INSERT INTO userData (name, email, customerID, password, activeAccount) VALUES ('$fullName', '$email', '$customerID', '$password', '$accountID')");
    session_start();
    $_SESSION['customerID'] = $customerID;
    echo "<script type = 'text/javascript'>window.location.assign('index.php');</script>";

?>