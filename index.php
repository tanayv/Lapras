<?php

	session_start();
	$loadCustID = $_SESSION['customerID'];
	
	if (!empty($loadCustID)) {
		echo "<script type = 'text/javascript'>window.location.assign('dashboard.php');</script>";
	}
	
	else {

?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Lapras</title>
	<link rel='stylesheet' type='text/css' href='login.css'>
	<meta charset='UTF-8'>
</head>
<body>

	<div id='container'>

		<h1>Lapras</h1>

		<div id='sign'>

			<form method='post' action='signInScript.php'>
                <?php 
                
                if ($_GET['error'] == 1)
                    echo "<span id='err_msg'>Incorrect Email ID or Password</span>";
                 
                ?>
				<input id='mail' type='email' name='email' placeholder='Email ID'>
				<input id='psswd' type='password' name='password' placeholder='Password'>
				<input id='bttn' type="submit" value='SIGN IN'>

			</form>

			<a href="signUp.php">SIGN UP</a>

		</div>

	</div>

</body>
</html>
<?php 
}

?>