<?php 
    /*
        Name: dashboard.php
        Function: Screen to be redirected to after successful sign-in.
    */
    session_start();
    $a = $_SESSION['customerID'];
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Lapras | Dashboard</title>
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

        <img class='bot-gif' onclick='openNav()' src='assets/lapras-repeat.gif'>

        <div class='top-nav'>

            <div class='top-nav-content'>

                <img src='assets/profile.png'>
                <p>Siddharth Bhogra</p>

            </div>

            <div class='up'>

                <p>DASHBOARD</p>

            </div>

        </div>

        <div class='side-nav'>

            <div class='logo'>

                <img src="assets/logo.png">

            </div>

            <ul>
                <li><a href='#'><img src='assets/home.png'>HOME</a></li>
                <!-- <li><a href='#'><img src='assets/account.png'>ACCOUNTS</a></li> -->
                <li><a href='statement.php'><img src='assets/vault.png'>BANK STATEMENTS</a></li>
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