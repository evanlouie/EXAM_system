<?php
require "../_functions/functions.php";
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EXAM System</title>
	<link rel="stylesheet" type="text/css" href="../_css/styles.css"/>
</head>
<body>

<div id="container">
	<h1>User Registration</h1>

	<div id="body">
		<p>Fill out all information:</p>
		<code>
			<p>Note: Keep your passwords simple (letters and numbers), security measures will mess up your password if you start using escapable strings. If you have no idea what and escapable string is, then your probably fine.</p>
			<form method="post" action="newUser.php">
				<table>
					<tr>
						<td>First Name:</td>
						<td><input type="text" name="fname" value="" size=50></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input type="text" name="lname" value="" size=50></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="email" value="" size=50></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" value="" size=50></td>
					</tr>
					<tr>
						<td></td>
						<td><input style="float:right;" type="submit" value="Register"></td>
					</tr>
				</table>
			</form>
		</code>
	</div>

	<?php echoFooter(); ?>
</div>

</body>
</html>