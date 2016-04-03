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
       //mysqli_query($connection, "INSERT INTO botMsg (customerID, accountID, sender, content, seshID) VALUES ('$customerID', '$accountID', '0', '$userMsgEsc', '$seshID')");
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        
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
        
        //Load arrays of keywords
        $firstLvlKeywords = array(
        array("expenditure", "spending", "spend", "spent"),     //Set action1 = 0
        array("income", "earnt", "earn", "qwzc", "qwzx"),       //Set action1 = 1
        array("upcoming", "pending", "subscription", "qwzx"),   //Set action1 = 2
        array("afford", "qwxz", "qwzx", "qwzx", "qwzx")         //Set action1 = 3
        );
        
        $secondLvlKeywords = array("this week", "last week", "this month");
            
            //First level lookup
            $actionMsg = strtolower($userMsg);
            
            for ($j = 0; $j < sizeof($firstLvlKeywords); $j++)
                for ($k = 0; $k < 4; $k++) {
                    
                    if (strpos($actionMsg, $firstLvlKeywords[$j][$k])!=false) {
                        $action1 = $j;
                    }
                }
        
            //Second level lookup
                $durationFlag = false;
                for ($l = 0; $l < 3; $l++) {
                    
                    if (strpos($actionMsg, $secondLvlKeywords[$l])!=false) {
                        echo "FOUND";
                        $durationFlag = true;
                    }
                }
                
                if ($durationFlag != true)
                    $action2 = 0;
                
        echo "$action1 on $secondLvlKeywords[$action2]";
        echo $actionMsg;
            
        
        //mysqli_query($connection, "INSERT INTO botMsg (customerID, accountID, sender, content, seshID) VALUES ('$customerID', '$accountID', '1', '$botMsg', '$seshID')");
        //echo "<script type = 'text/javascript'>window.location.assign('dashboard.php');</script>";

?>