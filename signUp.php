<?php
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

			<form method='post' action='signUpScript.php'>

				<input id='naam' type='text' name='name' placeholder='Name'>
				<input id='acct' type='text' name='custID' placeholder='Customer ID'>
				<input id='mail' type='email' name='email' placeholder='Email ID'>
				<input id='psswd' type='password' name='pass1' placeholder='Password'>
				<input id='bttn' type="submit" value='SIGN UP'>

			</form>
			
			<a href="index.php">SIGN IN</a>

		</div>

	</div>

</body>
</html>