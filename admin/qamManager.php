<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$sqam = new section_question_answer_map;
$qam = new question_answer_map;

if (isset($_GET['create']) && isset($_GET['section_id']) && isset($_GET['question_id']) && isset($_GET['answer_id'])) {
	$sqam_id = $sqam -> get_sqam_id_from_section_and_question($_GET['section_id'], $_GET['question_id']);
	$qam -> set_sqam_id($sqam_id);
	$qam -> set_answer_id($_GET['answer_id']);
	$qam -> saveToDatabase();
}
if (isset($_GET['delete']) && isset($_GET['section_id']) && isset($_GET['question_id']) && isset($_GET['answer_id'])) {
	$sqam_id = $sqam -> get_sqam_id_from_section_and_question($_GET['section_id'], $_GET['question_id']);
	$qam -> set_answer_id($_GET['answer_id']);
	$qam -> set_sqam_id($sqam_id);
	$qam -> deleteFromDatabase();

}
?>