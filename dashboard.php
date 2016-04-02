<?php 

    /*
        Name: dashboard.php
        Function: Screen to be redirected to after successful sign-in.
    */

    session_start();
    $a = $_SESSION['customerID'];
    echo "Customer ID: " . $a . "<BR>";
    
    echo "<a href='signOutScript.php'>Sign Out</a> <BR><BR>";
    
    $url = 'http://api.reimaginebanking.com/customers/' . $a . '/accounts?key=e567da9aeeb79795c54bf9af975f856e';
    $xml = file_get_contents($url);
    
    //echo $xml;
    $arrCustAccs = json_decode($xml, true);
    
    //echo $myArray[0]['_id'];
    
    $sizeArrCustAccs = sizeof($arrCustAccs);
    for ($i = 0; $i<sizeof($arrCustAccs); $i++) {
        $accountID = $arrCustAccs[$i]['_id'];
        $lnkBalance = " <a href='accountBal.php?accID=" . $accountID . "'> View </a>";
        echo "Account: " . $arrCustAccs[$i]['nickname'] . $lnkBalance . "<br>";
    }
?>