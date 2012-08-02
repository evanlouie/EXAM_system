<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$sqam = new section_question_answer_map;

if (isset($_GET['create']) && isset($_GET['section_id']) && isset($_GET['question_id']) && isset($_GET['answer_id']) && isset($_GET['status'])) {
	$sqam -> set_section_id($_GET['section_id']);
	$sqam -> set_question_id($_GET['question_id']);
	$sqam -> set_answer_id($_GET['answer_id']);
	$sqam -> set_status($_GET['status']);
	$sqam -> saveToDatabase();
}
if (isset($_GET['delete']) && isset($_GET['sqam_id'])) {
	$sqam -> getFromDB($_GET['sqam_id']);
	$sqam -> deleteFromDB();
}
if (isset($_GET['edit']) && isset($_GET['section_id']) && isset($_GET['question_id']) && isset($_GET['answer_id']) && isset($_GET['status'])) {
	$sqam -> set_section_id($_GET['section_id']);
	$sqam -> set_question_id($_GET['question_id']);
	$sqam -> set_answer_id($_GET['answer_id']);
	$sqam -> set_status($_GET['status']);
	$sqam -> updateInDB();
}
?>