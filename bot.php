<?php
    
    include 'engine/connection.php';
    
    $userMsg = mysqli_real_escape_string($connection, $_POST['userMsg']);
    
    //Obtain Variables from Session
    session_start();
    $customerID = $_SESSION['customerID'];
    $accountID = '';
        
        /*
        //Use customerID to find active account
        $query1 = mysqli_query($connection, "SELECT * FROM userData WHERE customerID = '$customerID'");
        while ($row = mysqli_fetch_array($query1)) {
            $accountID = $row['activAccount'];
        }
        */
        
        //Save user message
       mysqli_query($connection, "INSERT INTO botMsg (customerID, accountID, sender, content) VALUES ('$customerID', 'ABC', '0', '$userMsg')");
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        
        $botMsg = mysqli_real_escape_string($connection, "I'm afraid I can't do that Dave");
        /*
            BOT PROCESSES USER MESSAGE
        */
        
        mysqli_query($connection, "INSERT INTO botMsg (customerID, accountID, sender, content) VALUES ('$customerID', 'ABC', '1', '$botMsg')");
        echo "<script type = 'text/javascript'>window.location.assign('dashboard.php');</script>";

?>