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

<!DOCTYPE HTML>
<html>
<head>
    <title>Lapras | Dashboards</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <meta charset='UTF-8'>
</head>
<body>

    <div id='container'>

        <div id='bot-overlay' class='overlay'>

          <a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>×</a>

          <div class='overlay-content'>

            <form method='post' action='bot.php'>

                <input class='bot' type='text' name='userMsg' placeholder='Speak, human...'>
                <input id='bot-submit' type='submit'>   

            </form>

          </div>

        </div>

        <img class='bot-gif' onclick='openNav()' src='assets/lapras-repeat.gif'>

    </div>

    <script type='text/javascript'>

        function openNav() {
            document.getElementById('bot-overlay').style.height = '100%';
        }

        function closeNav() {
            document.getElementById('bot-overlay').style.height = '0%';
        }

    </script>

</body>
</html>