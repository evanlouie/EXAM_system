<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$answer = new answer;

if (isset($_GET['create']) && isset($_GET['answer'])) {
	$answer -> set_answer($_GET['answer']);
	$answer -> saveToDatabase();
}
if (isset($_GET['delete']) && isset($_GET['answer_id'])) {
	$answer -> getFromDB($_GET['answer_id']);
	$answer -> deleteFromDB();
}
if (isset($_GET['edit']) && isset($_GET['answer']) && isset($_GET['answer_id'])) {
	$answer -> getFromDB($_GET['answer_id']);
	$answer -> set_answer($_GET['answer']);
	$answer -> updateAnswerInDB();
}
?>