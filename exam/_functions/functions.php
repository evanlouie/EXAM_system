<?php

function createExam($exam_id) {
	$exam = new exam;
	$exam -> getFromDB($exam_id);

	$everything = $exam -> getAllSQAM();

	$e = new examManager;
	$e -> set_exam_id($exam -> get_exam_id());
	$e -> set_title($exam -> get_title());

	foreach ($everything as $key => $sqamap) {
		$question = new question;
		$answer = new answer;
		$section = new section;
		$qam = new question_answer_map;
		$sqam = new sectionQuestionAnswerManager;

		$question -> getFromDB($sqamap -> question_id);
		$answer -> getFromDB($sqamap -> answer_id);
		$section -> getFromDB($sqamap -> section_id);
		$incorrectAnswers = $qam -> get_all_answer_id_from_sqam_id($sqamap -> sqam_id);
		$sqamm = new section_question_answer_map;
		$sqamm ->getFromDB($sqamap->sqam_id);
		$incorrectAnswers = $sqamm ->getAllAssociatedAnswersAsObjectArray();

		$sqam -> set_question_id($question -> get_question_id());
		$sqam -> set_question($question -> get_question());
		$sqam -> set_answer($answer -> get_answer());
		$sqam -> set_answer_id($answer -> get_answer_id());
		$sqam -> set_sectionTitle($section -> get_title());
		$sqam -> set_section_id($section -> get_section_id());
		while (!empty($incorrectAnswers)) {
			$a = new answer;
			$a_idObject = array_pop($incorrectAnswers);
			$a -> getFromDB($a_idObject -> answer_id);
			$sqam -> addToIncorrectAnswers($a -> get_answer_id(), $a -> get_answer());
		}
		$e -> addQuestionAnswerManagerTosqam($sqam);

	}

	return $e;

}

function getExamDividedIntoSections(examManager $exam) {
	$sections = array();
	foreach ($exam->sqams as $key => $sqam) {
		$sections[$sqam -> section_id] = array();
	//	var_dump($sqam);
	}
	foreach ($exam->sqams as $key => $sqam) {
		array_push($sections[$sqam -> section_id], $sqam);
	}
	$e = $sections;

	return $e;
}
?>