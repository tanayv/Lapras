<?php

    session_start();
    
    $customerID = $_SESSION['customerID'];
    echo "Customer ID: " . $customerID . "<BR>";

     /* Request 1 
        To: Account
        Parameters: CustomerID
        Purpose: Fetch account information from customerID
    */
    
    $url = 'http://api.reimaginebanking.com/customers/' . $customerID . '/accounts?key=e567da9aeeb79795c54bf9af975f856e';
    $xml = file_get_contents($url);
    $arrCustAccs = json_decode($xml, true);
    $sizeArrCustAccs = sizeof($arrCustAccs);
    for ($i = 0; $i<sizeof($arrCustAccs); $i++) {
        $accountID = $arrCustAccs[$i]['_id'];
        $balance = $arrCustAccs[$i]['balance'];
        $rewards = $arrCustAccs[$i]['rewards'];
        $type = $arrCustAccs[$i]['type'];
        echo "<p><b>Account: " . $arrCustAccs[$i]['nickname'] . "</b><br>
                ID: $accountID <br>
                Type: $type <br>
                Balance: $balance <br>
                Rewards: $rewards <br>
                </p> <br>";
        
    }
    
    /* Request 2 
        To: Bill
        Parameters: CustomerID
        Purpose: Fetch all bills that belong to a customer
    */
    
    $url2 = 'http://api.reimaginebanking.com/customers/' . $customerID . '/bills?key=e567da9aeeb79795c54bf9af975f856e';
    $xml2 = file_get_contents($url2);
    $accBillLog = json_decode($xml2, true);
    
    $sizeArr2 = sizeof($accBillLog);
    $tableHTML1 = "<br><b>Recent Activity</b><br><table>
                    <tr>
                        <th>Date</th>
                        <th>Payee</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>";
    for ($i = 0; $i<$sizeArr2; $i++) {
        $date = $accBillLog[$i]['creation_date'];
        $payee = $accBillLog[$i]['payee'];
        $amount = $accBillLog[$i]['payment_amount'];
        $status = $accBillLog[$i]['status'];
        $tableHTML1 .= "<tr>
                            <td>$date</td>
                            <td>$payee</td>
                            <td>$$amount</td>
                            <td>$status</td>";
    }
    
    echo $tableHTML1;
    /*
    echo "<br> <b>Name: " . $accInfo['nickname'] . "</b><BR>";
    echo "Rewards: " . $accInfo['rewards'] . "<BR>";
    echo "Balance: $" . $accInfo['balance'] . "<BR>";
    echo "Type: " . $accInfo['type'] . "<BR>";
    */
    
?>