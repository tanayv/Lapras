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
        3               Last Month
    
    */
    
    
    
    function botThink($action1, $action2) {
        $botResponse = "";
        
        //IMPORTANT FEATURE: Loop through all transactions
        $customerID = $_SESSION['customerID'];
        $url2 = 'http://api.reimaginebanking.com/customers/' . $customerID . '/bills?key=e567da9aeeb79795c54bf9af975f856e';
        $xml2 = file_get_contents($url2);
        $accBillLog = json_decode($xml2, true);
        
        $expRunSum = 0;
        
        $sizeArr2 = sizeof($accBillLog);
        for ($i = 0; $i<$sizeArr2; $i++) {
            $sampleDate = $accBillLog[$i]['payment_date'];
        
        //IMPORTANT FEATURE: Time Frame Decider Based on sample Date [Change in Loop] 
        
        if ($action2 == 0) { //This Week
            $lMonDay = date('Y-m-d',strtotime('-1 Monday'));
            
            if (strtotime($sampleDate) > strtotime($lMonDay)) {
                //$botResponse .= "Sample Day is in this week";
                //Add Transaction to list
                $botPersona = "Your expenditure for this week so far is: $";
                $expRunSum += floatval($accBillLog[$i]['payment_amount']);
            }

        }
        
        elseif ($action2 == 1) { //Last Week
            $lMonDay = date('Y-m-d',strtotime('-1 Monday'));
            $l2MonDay = date('Y-m-d',strtotime('-2 Monday'));
            
            if ((strtotime($sampleDate) < strtotime($lMonDay)) && (strtotime($sampleDate) > strtotime($l2MonDay))) {
                //$botResponse .= "Sample Day was in the last week";
                //Add Transaction to list
                $botPersona = "Your expenditure for last week was: $";
                $expRunSum += floatval($accBillLog[$i]['payment_amount']);
            }
            
        }
        
        elseif ($action2 == 2) {
            $todayMonth = date(m);
            $todayYear = date(Y);
            $arrSamDate = explode("-", $sampleDate);
            
            if ($arrSamDate[0]==$todayYear && $arrSamDate[1]==$todayMonth) {
                //botResponse .= "Sample Day is in the same month";
                //Add Transaction to list
                $botPersona = "Your expenditure for this month so far is: $";
                $expRunSum += floatval($accBillLog[$i]['payment_amount']);
            }
            
        }
        
        elseif ($action2 == 3) {
            $todayMonth = date(m);
            $todayYear = date(Y);
            $lastMonth = m - 1;
            $arrSamDate = explode("-", $sampleDate);
            
            if ($arrSamDate[0]==$todayYear && ($arrSamDate[1]+1)==$todayMonth) {
                //botResponse .= "Sample Day is in the same month";
                //Add Transaction to list
                $botPersona = "Your expenditure for last month was: $";
                $expRunSum += floatval($accBillLog[$i]['payment_amount']);
            }
            
        }
        
        
        /*$payee = $accBillLog[$i]['payee'];
        $amount = $accBillLog[$i]['payment_amount'];
        $status = $accBillLog[$i]['status'];
        $tableHTML1 .= "<tr>
                            <td>$date</td>
                            <td>$payee</td>
                            <td>$$amount</td>
                            <td>$status</td>"; */
                            
    }
        
        
        $botResponse .= $botPersona . $expRunSum;
        
        return $botResponse;
    }


?>