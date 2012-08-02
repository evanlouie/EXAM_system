<?php
session_start();
foreach (glob("../../_classes/*.php") as $filename) {
	require "$filename";
}

if (isset($_GET['create']) && isset($_SESSION['user_id'])) {
	$attempt = new attempt;
	$attempt -> set_user_id($_SESSION['user_id']);
	$attempt -> set_score(0);
	$attempt -> saveToDB();
	
}
?>