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
        echo "<p class='acct'> <span class='heading'>" . $arrCustAccs[$i]['nickname'] . "</span><br>
                <div class='el'> <span class='heading1'> ID </span> <span class='right'> $accountID </span> </div>
                <div class='el'> <span class='heading1'> Type </span> <span class='right'> $type </span> </div>
                <div class='el'> <span class='heading1'> Balance </span> <span class='right'> $$balance </span> </div>
                <div class='el'> <span class='heading1'> Rewards </span> <span class='right'> $$rewards </span> </div>
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
    $tableHTML1 = "<br><p class='acct'><span class='heading'>Recent Activity</span></p><br><table>
                    <tr>
                        <th>DATE</th>
                        <th>PAYEE</th>
                        <th>AMOUNT</th>
                        <th>STATUS</th>
                    </tr>";
    for ($i = 0; $i<$sizeArr2; $i++) {
        $date = $accBillLog[$i]['payment_date'];
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
    echo "<br> <span class='heading'>Name: " . $accInfo['nickname'] . "</span><BR>";
    echo "Rewards: " . $accInfo['rewards'] . "<BR>";
    echo "Balance: $" . $accInfo['balance'] . "<BR>";
    echo "Type: " . $accInfo['type'] . "<BR>";
    */
    
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Lapras | Bank Statements</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <meta charset='UTF-8'>
</head>
<body>

    <div class='container'>

        <div id='bot-overlay' class='overlay'>

          <a href='javascript:void(0)' class='closebtn' onclick='closeNav()'>×</a>

          <div class='overlay-content'>

            <form method='post' action='bot.php'>

                <input id='user-msg' class='bot' type='text' name='userMsg' placeholder='Speak, human...'>
                <input onclick='moveTextBox()' id='bot-submit' type='submit'>   

            </form>

          </div>

        </div>

        <!-- <img class='bot-gif' onclick='openNav()' src='assets/lapras-repeat.gif'> -->

        <div class='top-nav'>

            <div class='top-nav-content'>

                <img src='assets/profile.png'>
                <p>Siddharth Bhogra</p>

            </div>

            <div class='up'>

                <p>BANK STATEMENTS</p>

            </div>

        </div>

        <div class='side-nav'>

            <div class='logo'>

                <img src="assets/logo.png">

            </div>

            <ul>
                <li><a href='dashboard.php'><img src='assets/home.png'>HOME</a></li>
                <!-- <li><a href='#'><img src='assets/account.png'>ACCOUNTS</a></li> -->
                <li><a href='#'><img src='assets/vault.png'>BANK STATEMENTS</a></li>
                <li><a href='#'><img src='assets/message.png'>MESSAGES</a></li>
            </ul>

            <div class='sign-out'>

                <a href='signOutScript.php'>SIGN OUT</a>

            </div>

        </div>

    </div>

    <script type='text/javascript'>
        function openNav() {
            document.getElementById('bot-overlay').style.height = '100%';
        }
        function closeNav() {
            document.getElementById('bot-overlay').style.height = '0%';
        }
        function moveTextBox() {
            document.getElementById('user-msg').style.top = '80%';
        }
    </script>

</body>
</html>