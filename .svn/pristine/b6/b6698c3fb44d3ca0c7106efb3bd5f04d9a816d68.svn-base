<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$exam = new exam;

if (isset($_GET['create']) && isset($_GET['title'])) {
	$exam -> set_title($_GET['title']);
	$exam -> saveToDB();
}
if (isset($_GET['delete']) && isset($_GET['exam_id'])) {
	$exam -> getFromDB($_GET['exam_id']);
	$exam -> deleteFromDB();
}
if (isset($_GET['edit']) && isset($_GET['title']) && isset($_GET['exam_id'])) {
	$exam -> getFromDB($_GET['exam_id']);
	$exam -> set_title($_GET['title']);
	$exam -> updateInDB();
}
?>