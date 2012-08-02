<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$question = new question;

if(isset($_GET['create']) && isset($_GET['question'])) {
	$question->set_question($_GET['question']);
	$question->saveToDatabase();
}
if (isset($_GET['delete']) && isset($_GET['question_id'])) {
	$question -> getFromDB($_GET['question_id']);
	$question -> deleteFromDB();
}
if (isset($_GET['edit']) && isset($_GET['question']) && isset($_GET['question_id'])) {
	$question -> getFromDB($_GET['question_id']);
	$question -> set_question($_GET['question']);
	$question -> updateQuestionInDB();
}

?>