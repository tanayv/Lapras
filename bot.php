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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        
        //$botMsg = mysqli_real_escape_string($connection, "I'm afraid I can't do that Dave");
        
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
        include 'engine/keywords.php';  
            //First level lookup
            $action1 = -1;
            
            for ($j = 0; $j < 4; $j++)
                for ($k = 0; $k < 4; $k++) {
                    if (stripos($userMsg, $firstLvlKeywords[$j][$k]) !== false ) {
                        //echo "Match Found -> ($j, $k) <br>";
                        $action1 = $j;
                    }
                }
                
            for ($i = 0; $i < 4; $i++) {
                    if (stripos($userMsg, $secondLvlKeywords[$i]) !== false ) {
                        //echo "Match Found -> ($i)";
                        $action2 = $i;
                    }
                }
        
            echo "<hr><p>Action1: $action1 <br> Action2: $action2</p>";
            
            include 'engine/botBrain1.php';
            include 'engine/botBrain2.php';
            
            if ($action1 == 3) 
                $botMsg = botThinkAdv($action1);
            
            else
                $botMsg = botThink($action1, $action2);
            
            //echo $botMsg;
            $botMsgEsc = mysqli_real_escape_string($connection, $botMsg);
            
        mysqli_query($connection, "INSERT INTO botMsg (customerID, accountID, sender, content, seshID) VALUES ('$customerID', '$accountID', '1', '$botMsgEsc', '$seshID')");
        echo "<script type = 'text/javascript'>window.location.assign('messages.php');</script>";

?>