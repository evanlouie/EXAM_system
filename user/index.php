<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
require "../_functions/functions.php";

session_start();
if (isset($_SESSION['user_id'])) {
	$user = new user;
	$user -> getFromDB($_SESSION['user_id']);
} else if (isset($_POST['email']) && isset($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$user = new user;
	if ($user -> userExists($email)) {
		$user -> getFromDB($user -> get_user_id_fromDB($email));
	} else {
		unset($user);
	}
}

if (isset($user)) {
	$_SESSION['user_id'] = $user -> get_user_id();
	$attempts = $user -> getAllAttemptObjects();
	$exam = new exam;
	$examArray = $exam -> getListOfAllExamsAsObjectArray();
	$examList = '';
	while (!empty($examArray)) {
		$e = array_pop($examArray);
		$examList .= "<option value='$e->exam_id'>$e->title</option>";
	}

	$h1 = "Welcome " . $user -> get_first_name() . ' ' . $user -> get_last_name();
	$p = "Past attempted exams:";
	if (empty($attempts)) {
		$code = "No past exams taken";
	} else {
		$code = "<table style='width:100%'><tbody><tr><td style='width:10%'><strong>Attempt ID</strong></td><td style='width:40%'><strong>Exam</strong></td><td><strong>Score</strong></td><td><strong>Date</strong></td></tr>";
		while (!empty($attempts)) {
			$attempt = array_pop($attempts);
			$code = $code . "<tr><td><a href='../attempt?attempt_id=$attempt->attempt_id'>$attempt->attempt_id</a></td><td>$attempt->title</td><td>$attempt->score /" . $exam -> getOutOfScore($attempt -> exam_id) . "</td><td>$attempt->timestamp</td></tr>";
		}
		$code = $code . "</tbody></table>";
	}
} else {
	$h1 = "Login Error!";
	$p = "Error:";
	$code = "Password or Email incorrect";
}
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EXAM System</title>
	<link rel="stylesheet" type="text/css" href="../_css/styles.css"/>
	<script type='text/javascript' src="../_script/jquery.js"></script>
	<script type='text/javascript'>
		$(document).ready(function() {
			$('#doExam').click(function() {
				$.get("_callbacks/attempt.php?create");
			})
		})
	</script>
</head>
<body>

<div id="container">
	<h1><?php echo $h1 ?></h1>

	<div id="body">
		
		<?php if (isset($_SESSION['user_id'])) {
			$admin = new admin;
			if ($admin->isAdmin($_SESSION['user_id'])) {
				echo "<code><a href='../admin/'>Contine to Admin Panel</a></code>";
			}
		?>
		<p>Welcome, please choose an exam to write</p>
		<code>
			Select Exam:
			<form method='post' action="../exam/">
				<select id="exam" name='exam_id'>
					<?php echo $examList ?>
				</select>
				<input type='submit' id='doExam' value='Go'/>
			</form>
		</code>
		<?php } ?>
		<p><?php echo $p ?></p>
		<code>
			<?php echo $code ?>
		</code>
		<code><a href='../'>Return to Home Page</a><br><a href='../logout.php'>Logout</a></code>
	</div>
	

	<?php echoFooter(); ?>
</div>

</body></html>