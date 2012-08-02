<?php

if (isset($_GET['checkAnswer']) && isset($_GET['exam_id']) && isset($_GET['section_id']) && isset($_GET['question_id']) && isset($_GET['answer_id'])) {
	$exam_id = $_GET['exam_id'];
	$section_id = $_GET['section_id'];
	$question_id = $_GET['question_id'];
	$answer_id = $_GET['answer_id'];
	mysql_connect("localhost", "root", "") or die(mysql_error());
	mysql_select_db("exam_system") or die(mysql_error());
	
	$query = "	SELECT
					*
				FROM
					exam as e,
					section_question_answer_map as sqam,
					exam_sqa_map as esm
				WHERE
					'$exam_id' = e.exam_id AND
					e.exam_id = esm.exam_id AND
					esm.sqam_id = sqam.sqam_id AND
					sqam.section_id = '$section_id' AND
					sqam.question_id = '$question_id' AND
					sqam.answer_id = '$answer_id'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_numrows($result)>0) {
		$answer = "correct";
	} else {
		$answer  = "incorrect";
	}
	echo "$answer";
}
?>