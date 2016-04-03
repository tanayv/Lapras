<?php 
    function botThinkAdv($action1) {
        $botResponse = "";

        /* RECIPE 
            1. Fetch Balance
            2. Calculate no. of days left
            3. Fetch and Calculate AvgDailyExpenditure
            4. Make Prediction
        */
        
        //1. Fetch Balance
        $customerID = $_SESSION['customerID'];
        $url1 = 'http://api.reimaginebanking.com/customers/' . $customerID . '/accounts?key=e567da9aeeb79795c54bf9af975f856e';
        $xml1 = file_get_contents($url1);
        $arrAccBal = json_decode($xml1, true);
        $balRunSum = 0;                             // <- Important Variable [Balance]
        $sizeArr1 = sizeof($arrAccBal);
        for ($i = 0; $i<$sizeArr1; $i++) {
            $balance = $arrAccBal[$i]['balance'];
            $balRunSum += $balance;  
        }
        
        //2. Calculate no. of days left
        $toDay = date(d);
        $monthNum = date(t);
        $daysRemaining = intval($monthNum - $toDay);    // <- Important Variable [DaysRemaining]
        
        //3. Fetch and Calculate avgDailyExp
        $url2 = 'http://api.reimaginebanking.com/customers/' . $customerID . '/bills?key=e567da9aeeb79795c54bf9af975f856e';
        $xml2 = file_get_contents($url2);
        $accBillLog = json_decode($xml2, true);
        
        $expRunSum = 0;
        $subRawAdd = 0;
        $sizeArr2 = sizeof($accBillLog);
        for ($i = 0; $i<$sizeArr2; $i++) {
            $sampleDate = $accBillLog[$i]['payment_date'];
            
            if (strcmp($accBillLog[$i]['status'], "recurring") != 0) {
            
            
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
            
            else {
                $recurDate = $accBillLog[$i]['payment_date'];
                $arrRecDate = explode("-", $recurDate);
                $recureDay = $arrRecDate[2];
                $toDay = intval(date(d));
                if ($toDay < $recureDay) {
                    $subRawAdd += $accBillLog[$i]['payment_amount'];
                }
                
            }
        }
        $lastMonthDays = cal_days_in_month(CAL_GREGORIAN, 3 ,$todayYear);
        $avgDailyExp = floatval($expRunSum / $lastMonthDays);
        
        //Bhogra Equation
        $balAfterM = round($balRunSum - ($subRawAdd + ($avgDailyExp * $daysRemaining)), 2);
        /*
            Sample Bot Respnse
            
            Hey there, your current balance is $balRunSum. Based on your average daily expenditure from last month,
            I expect you to finish the month with a balance of $balAfterM. As of now, you also have to pay recurring dues, which come out
            to be $subRawAdd. 
        
        */
        $botResponse .= "Hey there, your current balance is $$balRunSum. Based on your average daily expenditure from last month,
            I expect you to finish the month with a balance of $$balAfterM. I've also taken into account your upcoming recurring dues, which come out
            to be $$subRawAdd. ";
            
        return $botResponse;
    }

?>