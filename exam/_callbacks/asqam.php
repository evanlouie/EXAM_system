<?php
foreach (glob("../../_classes/*.php") as $filename) {
	require "$filename";
}
$asqam = new attempt_sqa_map;
$sqam = new section_question_answer_map;
$sqam_id = 0;
if (isset($_GET['section_id']) && isset($_GET['question_id'])) {
	$sqam_id = $sqam -> get_sqam_id_from_section_and_question($_GET['section_id'], $_GET['question_id']);
}
if (isset($_GET['create']) && isset($_GET['attempt_id']) && $sqam_id != 0 && isset($_GET['answer_id'])) {
	$asqam -> set_attempt_id($_GET['attempt_id']);
	$asqam -> set_sqam_id($sqam_id);
	$asqam -> set_answer_id($_GET['answer_id']);
	$asqam -> saveToDB();

} else if (isset($_GET['create']) && isset($_GET['attempt_id']) && $sqam_id != 0 && !isset($_GET['answer_id'])) {
	$asqam -> set_attempt_id($_GET['attempt_id']);
	$asqam -> set_sqam_id($sqam_id);
	$asqam -> saveToDBwithNULLAnswer();

}

if (isset($_GET['delete']) && isset($_GET['attempt_id']) && $sqam_id != 0 && isset($_GET['answer_id'])) {
	$asqam -> set_attempt_id($_GET['attempt_id']);
	$asqam -> set_sqam_id($sqam_id);
	$asqam -> set_answer_id($_GET['answer_id']);
	$asqam -> deleteFromDB();
}
?>
