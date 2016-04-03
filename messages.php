<?php 

    include 'engine/connection.php';
    session_start();
    $customerID = $_SESSION['customerID'];
    $seshID = $_SESSION['seshID'];
    echo $customerID;
    

    $query1 = mysqli_query($connection, "SELECT * FROM botMsg WHERE customerID = '$customerID' ORDER BY time DESC");
    while ($row = mysqli_fetch_array($query1)) {
        
        
        $content = $row['content'];
        $sender = $row['sender'];
        $timest = $row['time'];
        $msgSeshID = $row['seshID'];
        
        $RGBactive = 'rgb(0, 124, 130';
        $Hexinactive = '#00ADB5';
        
        if ($seshID != $msgSeshID) {    //Inactive
            if ($sender == 1) { //Message from bot
                echo "<p class='bot-msg'><span class='naam'>Lapras</span><br>$content<br>$timest<br></p>";
            }
        
            elseif ($sender == 0 ) { //Message from user
                echo "<p class='msg' style='background-color: $Hexinactive'><span class='naam'>You</span><br>$content<br>$timest<br></p>";    
            }
        }
        
        else {                      //Active
        
            if ($sender == 1) { //Message from bot
                echo "<p class='bot-msg'><span class='naam'>Lapras</span><br>$content<br>$timest<br></p>";
            }
        
            elseif ($sender == 0 ) { //Message from user
            echo "<p class='msg' style='background-color: $RGBactive'><span class='naam'>You</span><br>$content<br>$timest<br></p>";
            }
        }
    }

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

        <div id='talk-to-me2' onclick='openNav()'>

            <p>
                <img class='bot-gif' src='assets/bot-thumb.png'>
            </p>

        </div>

        <div class='top-nav'>

            <div class='top-nav-content'>

                <img src='assets/profile.png'>
                <p>Siddharth Bhogra</p>

            </div>

            <div class='up'>

                <p>MESSAGES</p>

            </div>

        </div>

        <div class='side-nav'>

            <div class='logo'>

                <img src="assets/logo.png">

            </div>

            <ul>
                <li><a href='dashboard.php'><img src='assets/home.png'>HOME</a></li>
                <li><a href='statement.php'><img src='assets/vault.png'>BANK STATEMENTS</a></li>
                <li><a href='messages.php'><img src='assets/message.png'>MESSAGES</a></li>
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
    </script>

</body>
</html>
