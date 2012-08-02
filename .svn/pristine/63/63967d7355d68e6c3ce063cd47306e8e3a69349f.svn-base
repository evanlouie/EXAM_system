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

	$question = new question;
	$questions = $question->getListOfAllQuestionsAsObjectArray();
	$questionList = '';
	while(!empty($questions)) {
		$q = array_pop($questions);
		$questionList .= "<option value='$q->question_id'>$q->question</option>";
	}
}
$code = 'Select entity type from menu above';
if (isset($_GET['question_id'])) {
	$question = new question;
	$question->getFromDB($_GET['question_id']);
	$code = "	<table style='width:100%'><tbody>
				<tr><td style='width:10%'>Question ID:</td><td id='question_id'>$question->question_id</td></tr>
				<tr><td>Question:</td><td><textarea rows='4' cols='100' id='questionQuestion'>$question->question</textarea></td></tr>
				<tr><td><button id='editQuestion'>Edit</button></td><td></td></tr>
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
			$('button#loadQuestion').click(function() {
				question_id = $('select#questionList').val();
				$('code#questionInfo').load('callbacks.php?load&question_id='+question_id);
			})
			$('button#editQuestion').live('click', function() {
				question_id = $('td#question_id').text();
				question = $('textarea#questionQuestion').val();
				$.get('callbacks.php?edit&question_id='+question_id+'&question='+question);
				$('#editQuestion').text('Done!');
			})
		})
		
	</script>

</head>
<body>

<div id="container">
	<h1>Question Management</h1>

	<div id="body">
		<select id="questionList" style="max-width:500px;">
			<?php echo $questionList ?>
		</select>
		
		<button id='loadQuestion'>Load question</button>
		<p>Entity List:</p>
		<code id='questionInfo'><?php echo $code?></code>
		<a href='index.php'>Return to type selector</a>

	</div>

	<?php echoFooter() ?>
</div>

</body>
</html>