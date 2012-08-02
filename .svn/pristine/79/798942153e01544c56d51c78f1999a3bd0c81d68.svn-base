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

	$exam = new exam;
	$exams = $exam->getListOfAllExamsAsObjectArray();
	$examList = '';
	while(!empty($exams)) {
		$e = array_pop($exams);
		$examList .= "<option value='$e->exam_id'>$e->title</option>";
	}
	
}
$code = "Select entity type from menu above";
if (isset($_GET['exam_id'])) {
		$exam = new exam;
		$exam->getFromDB($_GET['exam_id']);
		$code = "	<table style='width:100%'><tbody>
					<tr><td style='width:10%'>Exam ID:</td><td id='exam_id'>$exam->exam_id</td></tr>
					<tr><td>Title:</td><td><input size=50 type='text' id='examTitle' value='$exam->title' /></td></tr>
					<tr><td><button id='editExam'>Edit</button></td><td></td></tr>
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
			
			$('button#loadExam').click(function() {
				exam_id = $('select#examList').val();
				//alert('callbacks.php?'+type)
				$('code#examInfo').load('callbacks.php?load&exam_id='+exam_id);
			})
			$('button#editExam').live('click', function() {
				exam_id = $('td#exam_id').text();
				title = $('input#examTitle').val();
				$.get('callbacks.php?edit&exam_id='+exam_id+'&title='+title);
				$('#editExam').text('Done!');
			})

		})
		
	</script>

</head>
<body>

<div id="container">
	<h1>Exam Management</h1>

	<div id="body">
		<select id="examList">
			<?php echo $examList ?>
		</select>
		
		<button id='loadExam'>Load Exam</button>
		<p>Entity List:</p>
		<code id='examInfo'><?php echo $code ?></code>
		<a href='index.php'>Return to type selector</a>

	</div>

	<?php echoFooter() ?>
</div>

</body>
</html>