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
        $botResponse = "";
        
        
        
        
        //IMPORTANT FEATURE: Time Frame Decider Based on sample Date [Change in Loop] 
        $sampleDate = "2016-04-26";
        
        if ($action2 == 0) { //This Week
            $lMonDay = date('Y-m-d',strtotime('-1 Monday'));
            
            if (strtotime($sampleDate) > strtotime($lMonDay)) {
                //$botResponse .= "Sample Day is in this week";
                //Add Transaction to list
            }

        }
        
        elseif ($action2 == 1) { //Last Week
            $lMonDay = date('Y-m-d',strtotime('-1 Monday'));
            $l2MonDay = date('Y-m-d',strtotime('-2 Monday'));
            
            if ((strtotime($sampleDate) < strtotime($lMonDay)) && (strtotime($sampleDate) > strtotime($l2MonDay))) {
                //$botResponse .= "Sample Day was in the last week";
                //Add Transaction to list
            }
            
        }
        
        elseif ($action2 == 2) {
            $todayMonth = date(m);
            $todayYear = date(Y);
            $arrSamDate = explode("-", $sampleDate);
            
            if ($arrSamDate[0]==$todayYear && $arrSamDate[1]==$todayMonth) {
                //botResponse .= "Sample Day is in the same month";
                //Add Transaction to list
            }
            
        }
        
        return $botResponse;
    }


?>