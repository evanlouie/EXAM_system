<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$esm = new exam_sqa_map;
$sqam = new section_question_answer_map;

if (isset($_GET['create']) && isset($_GET['exam_id']) && isset($_GET['section_id']) && isset($_GET['question_id'])) {
	$sqam_id = $sqam->get_sqam_id_from_section_and_question($_GET['section_id'], $_GET['question_id']);
	$esm -> set_exam_id($_GET['exam_id']);
	$esm -> set_sqam_id($sqam_id);
	$esm -> saveToDB();
}
if (isset($_GET['delete']) && isset($_GET['exam_id']) && isset($_GET['section_id']) && isset($_GET['question_id'])) {
	$sqam_id = $sqam->get_sqam_id_from_section_and_question($_GET['section_id'], $_GET['question_id']);
	$esm -> set_exam_id($_GET['exam_id']);
	$esm -> set_sqam_id($sqam_id);
	$esm -> deleteFromDB();
}

?>