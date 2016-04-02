<?php

    $accountID = $_GET['accID'];
    echo "AccountID: ".  $accountID;
    
    
    /* Request 1 
        To: Account
        Purpose: Fetch account information
    */
    
    $url1 = 'http://api.reimaginebanking.com/accounts/' . $accountID . '?key=e567da9aeeb79795c54bf9af975f856e';
    $xml1 = file_get_contents($url1);
    $accInfo = json_decode($xml1, true);
    echo "<br> <b>Name: " . $accInfo['nickname'] . "</b><BR>";
    echo "Rewards: " . $accInfo['rewards'] . "<BR>";
    echo "Balance: $" . $accInfo['balance'] . "<BR>";
    echo "Type: " . $accInfo['type'] . "<BR>";
    
    
    /* Request 2
        To: Bills
        Purpose: Fetch Activity component; Bills
    */
    
    $url2 = 'http://api.reimaginebanking.com/accounts/' . $accountID . '/bills?key=e567da9aeeb79795c54bf9af975f856e';
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