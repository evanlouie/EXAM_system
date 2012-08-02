<?php
foreach (glob("../../_classes/*.php") as $filename) {
	require "$filename";
}

$aem = new attempt_exam_map;

if (isset($_GET['create']) && isset($_GET['attempt_id']) && isset($_GET['exam_id'])) {
	$aem -> set_attempt_id($_GET['attempt_id']);
	$aem -> set_exam_id($_GET['exam_id']);
	$aem -> saveToDB();
}
if (isset($_GET['delete']) && isset($_GET['attempt_id']) && isset($_GET['exam_id'])) {
	$aem -> deleteFromDB($_GET['attempt_id'], $_GET['exam_id']);
}
?>