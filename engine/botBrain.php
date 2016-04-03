<?php
    /* 
        Return Value: String 
    
    
        Value Map
        
        Action 1    |   Task
        -----------------------------------------------------------------
        0            Fetch Expenditure Data (Bills from given time frame)
        1            Fetch Income in given time frame
        2            Fetch recurring subscriptions from time frame
        3            Afford* Special
        
        
        Action 2    |  Meaning     |   Procedure
        ------------------------------------------------------------------------------------------------------------------
        0               This Week       Find previous monday and locate transactions onward        
        1               Last Week       Find previous monday and locate monday before that and locate transactions between            
        2               This Month      find month number and use it
    
    */
    
    
    
    function botThink($action1, $action2) {
        $botResponse = "Test";
        
        //Sort Time Frame out
        
        if ($action2 == 0) { //This Week
            $todayDay = date(N);
            
        }
        
        elseif ($action2 == 1) {
            
            
        }
        
        elseif ($action2 == 2) {
            
            
        }
        
        return $botResponse;
    }


?>