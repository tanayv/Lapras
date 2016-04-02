<?php
    
    include 'engine/connection.php';
    
    $userMsg = $_POST['userMsg'];
    
    //Obtain Variables from Session
    session_start();
    $customerID = $_sESSION['customerID'];
        
        //Use customerID to find active account
        $query1 = mysqli_query($connection, "SELECT * FROM userData WHERE customerID = '$customerID'");
        while ($row = mysqli_fetch_array($query1)) {
            $accountID = $row['activAccount'];
        }
    
        //Save user message
        mysqli_query($connection, "INSERT INTO botMsg ('customerID', 'accountID', 'sender', 'content') VALUES ($customerID, $accountID, 'user', $userMsg)");
        
        
        $botMsg = "I'm afraid i can't do that Dave";
        /*
            BOT PROCESSES USER MESSAGE
        */
        
        mysqli_query($connection, "INSERT INTO botMsg ('customerID', 'accountID', 'sender', 'content') VALUES ($customerID, $accountID, 'bot', $botMsg)");
        

?>