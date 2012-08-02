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

	while(!empty($userObjList)) {
		$u = array_pop($userObjList);
		$tuser = new user;
		$tuser->getFromDB($u->user_id);
		$userList .= "<option value=". $tuser->get_user_id(). ">". $tuser->get_first_name(). " ".  $tuser->get_last_name() . "</option>";
	}
	
}
if(isset($_POST['updateUser'])) {
	$user = new user;
	$user->getFromDB($_POST['user_id']);
	$user->set_email($_POST['email']);
	$user->set_first_name($_POST['fname']);
	$user->set_last_name($_POST['lname']);
	$user->set_password($_POST['password']);
	$user->updateInDB();
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
			
			$('button#loadType').click(function() {
				type = $('select#typeList').val();
				//alert('callbacks.php?'+type)
				$('code#entityInfo').load('callbacks.php?'+type);
			})

		})
		
	</script>

</head>
<body>

<div id="container">
	<h1>Exam | Section | Question | Answer Management</h1>

	<div id="body">
		<select id="typeList">
			<option value='exams'>Exams</option>
			<option value='sections'>Sections</option>
			<option value='questions'>Questions</option>
			<option value='answers'>Answers</option>
		</select>
		
		<button id='loadType'>Load Type</button>
		<p>Entity List:</p>
		<code id='entityInfo'>Select entity type from menu above</code>
		<a href='..'>Return to Exam | Section | Question | Answer Mapper</a>


	</div>

	<?php echoFooter() ?>
</div>

</body>
</html>