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
	$admin = new admin;
	$admin->set_user_id($_POST['user_id']);
	if (isset($_POST['admin'])) {
		if ($_POST['admin'] == 'on') {
			$admin->saveToDB();
		}
	} else {
		$admin->deleteFromDB();
	}
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
			
			$('button#loadUser').click(function() {
				user_id = $('select#userList').val();
				if (user_id != '') {
					$('code#userInfo').load('callbacks.php?load&user_id='+user_id);
					$('code#pastAttempts').load('callbacks.php?loadAttempts&user_id='+user_id);
				}
				
			})
			$(document).on('click', 'button#updateUser', function() {
				fname = $('input#fname').val();
				lname = $('input#lname').val();
				email = $('input#email').val();
				password = $('input#password').val();
			})
			$(document).on('click', 'button.updateAttempt', function () {
				attempt_id = $(this).closest('tr').find('.attempt_id').text();
				score = $(this).closest('tr').find('.score').val();
				outOf= $(this).closest('tr').find('.outOf').val();
				$.get('callbacks.php?edit&attempt_id='+attempt_id+'&score='+score+'&outOf='+outOf);
				$(this).text('Done!');
			})
			$(document).on('click', 'button.deleteUser', function() {
				confirm = confirm("Note: This will complete erase all information associated with this account; including personal and affiliated attempt information. Do you wish to continue?");
				if (confirm==true) {
					user_id = $('input:hidden').val();
					$.get('callbacks.php?delete&user_id='+user_id);
				}
			})
		})
		
	</script>

</head>
<body>

<div id="container">
	<h1>User Management</h1>

	<div id="body">
		<select id="userList">
			<option value=''></option>
			<?php echo $userList ?>
		</select>
		
		<button id='loadUser'>Load User</button>
		<p>User Info:</p>
		<code id='userInfo'>Select user from menu above</code>

		<p>Past exam attempts:</p>
		<code id='pastAttempts'>Select user from menu</code>
		<a href='..'>Return to Exam | Section | Question | Answer Mapper</a>


	</div>

	<?php echoFooter() ?>
</div>

</body>
</html>