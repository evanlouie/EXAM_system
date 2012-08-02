<?php
foreach (glob("../../_classes/*.php") as $filename) {require "$filename";}
require "../../_functions/functions.php";
session_start();
if (!isset($_SESSION['user_id'])) {
	die("User ID not set, please return to homepage to login");
} else {
	$admin = new admin;
	$user = new user;
	$user->getFromDB($_SESSION['user_id']);
	$user_id = $user->get_user_id();
	if(!$admin->isAdmin($user_id)) {
		die("You do not have administative rights");	
	}
	$userObjList = array();
	$userObjList = $user->getAllUserID();
	$userList = '';

	$answer = new answer;
	$answers = $answer->getListOfAllanswersAsObjectArray();
	$answerList = '';
	while(!empty($answers)) {
		$a = array_pop($answers);
		$answerList .= "<option value='$a->answer_id'>$a->answer</option>";
	}
}

$code = 'Select entity type from menu above';
if (isset($_GET['answer_id'])) {
		$answer = new answer;
		$answer->getFromDB($_GET['answer_id']);
		$code = "	<table style='width:100%'><tbody>
					<tr><td style='width:10%'>Answer ID:</td><td id='answer_id'>$answer->answer_id</td></tr>
					<tr><td>Answer:</td><td><textarea rows='4' cols='100' id='answerAnswer'>$answer->answer</textarea></td></tr>
					<tr><td><button id='editAnswer'>Edit</button></td><td></td></tr>
					</tbody></table>";
}



?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EXAM System</title>
	<link rel="stylesheet" type="text/css" href="../../_css/styles.css"/>
	<script type="text/javascript" src="../../_script/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('button#loadAnswer').click(function() {
				answer_id = $('select#answerList').val();
				$('code#answerInfo').load('callbacks.php?load&answer_id='+answer_id);
			})
			$('button#editAnswer').live('click', function() {
				answer_id = $('td#answer_id').text();
				answer = $('textarea#answerAnswer').val();
				$.get('callbacks.php?edit&answer_id='+answer_id+'&answer='+answer);
				$('#editAnswer').text('Done!');
			})
		})
		
	</script>

</head>
<body>

<div id="container">
	<h1>Answer Management</h1>

	<div id="body">
		<select id="answerList" style="max-width:500px;">
			<?php echo $answerList ?>
		</select>
		
		<button id='loadAnswer'>Load answer</button>
		<p>Entity List:</p>
		<code id='answerInfo'><?php echo $code ?></code>
		<a href='index.php'>Return to type selector</a>

	</div>

	<?php echoFooter() ?>
</div>

</body>
</html>