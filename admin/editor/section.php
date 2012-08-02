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
	
	$section = new section;
	$sections = $section->getListOfAllSectionsAsObjectArray();
	$sectionList = '';
	while(!empty($sections)) {
		$s = array_pop($sections);
		$sectionList .= "<option value='$s->section_id'>$s->title</option>";
	}
}
$code = 'Select entity type from menu above';
if (isset($_GET['section_id'])) {
	$section = new section;
	$section->getFromDB($_GET['section_id']);
	$code = "	<table style='width:100%'><tbody>
				<tr><td style='width:10%'>Section ID:</td><td id='section_id'>$section->section_id</td></tr>
				<tr><td>Title:</td><td><input size=50 type='text' id='sectionTitle' value='$section->title' /></td></tr>
				<tr><td><button id='editSection'>Edit</button></td><td></td></tr>
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
			$('button#loadSection').click(function() {
				section_id = $('select#sectionList').val();
				$('code#sectionInfo').load('callbacks.php?load&section_id='+section_id);
			})
			$('button#editSection').live('click', function() {
				section_id = $('td#section_id').text();
				title = $('input#sectionTitle').val();
				$.get('callbacks.php?edit&section_id='+section_id+'&title='+title);
				$('#editSection').text('Done!');
			})

		})
		
	</script>

</head>
<body>

<div id="container">
	<h1>Section Management</h1>

	<div id="body">
		<select id="sectionList">
			<?php echo $sectionList ?>
		</select>
		
		<button id='loadSection'>Load Section</button>
		<p>Entity List:</p>
		<code id='sectionInfo'><?php echo $code ?></code>
		
		<a href='index.php'>Return to type selector</a>


	</div>

	<?php echoFooter() ?>
</div>

</body>
</html>