<?php
    
    include 'engine/connection.php';
    
    $userMsg = $_POST['userMsg'];
    $userMsgEsc = mysqli_real_escape_string($connection, $userMsg);
    
    //Obtain Variables from Session
    session_start();
    $customerID = $_SESSION['customerID'];
    $seshID = $_SESSION['seshID'];
    $accountID = '';
        
        
        //Use customerID to find active account
        $query1 = mysqli_query($connection, "SELECT * FROM userData WHERE customerID = '$customerID'");
        while ($row = mysqli_fetch_array($query1)) {
            $accountID = $row['activeAccount'];
        }
        
        
        //Save user message
       mysqli_query($connection, "INSERT INTO botMsg (customerID, accountID, sender, content, seshID) VALUES ('$customerID', '$accountID', '0', '$userMsgEsc', '$seshID')");
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        
        $botMsg = mysqli_real_escape_string($connection, "I'm afraid I can't do that Dave");
        
        /*
            BOT PROCESSES USER MESSAGE
            
            
            User Message Analysis
                1. Break the sentence into an array of words.
                2. Compare each word with word positions 
                
                
            Question Sets:
            
            A. What was my expenditure last week?
                First Lookup -> Expenditure
                Second Lookup -> Time Frame : last week
        */
        
        //Split message into array of words
        $userMsgWords = explode(" ", $userMsg);
        for ($i = 0; $i < sizeof($userMsgWords); $i++) { //Perform First Lookup
            
        }
        
        
        mysqli_query($connection, "INSERT INTO botMsg (customerID, accountID, sender, content, seshID) VALUES ('$customerID', '$accountID', '1', '$botMsg', '$seshID')");
        echo "<script type = 'text/javascript'>window.location.assign('dashboard.php');</script>";

?>