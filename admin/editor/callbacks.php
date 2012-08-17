<?php
foreach (glob("../../_classes/*.php") as $filename) {
	require "$filename";
}

if (isset($_GET['exams'])) {
	$exam = new exam;
	$exams = $exam -> getListOfAllExamsAsObjectArrayIncludingDisabled();
	$code = "<table style='width:100%'><tbody><tr><td style='width:10%'><strong>Exam ID</strong></td><td><strong>Exam Title</td><td><strong>Status</strong></td><td><strong>Enable</strong></td><td><strong>Disable</strong></td></tr>";
	while (!empty($exams)) {
		$exam = array_pop($exams);
		$code = $code . "	<tr>
							<td class = 'exam_id'>$exam->exam_id</td>
							<td><a href='exam.php?exam_id=$exam->exam_id'>$exam->title</a></td>
							<td>$exam->status</td>
							<td><button class='enableExam'>Enable</button></td>
							<td><button class='disableExam'>Disable</button>
							</tr>";
	}
	$code = $code . "</tbody></table>";
	echo $code;
}
if (isset($_GET['sections'])) {
	$section = new section;
	$sections = $section->getListOfAllSectionsAsObjectArrayIncludingDisabled();
	$code = "<table style='width:100%'><tbody><tr><td style='width:10%'><strong>Section ID</strong></td><td><strong>Section Title</td><td><strong>Status</strong></td><td><strong>Enable</strong></td><td><strong>Disable</strong></td></tr>";
	while (!empty($sections)) {
		$section = array_pop($sections);
		$code = $code . "	<tr>
							<td class='section_id'>$section->section_id</td>
							<td><a href='section.php?section_id=$section->section_id'>$section->title</a></td>
							<td>$section->status</td>
							<td><button class='enableSection'>Enable</button></td>
							<td><button class='disableSection'>Disable</button>
							</tr>";
	}
	$code = $code . "</tbody></table>";
	echo $code;
}
if (isset($_GET['questions'])) {
	$question = new question;
	$questions = $question->getListOfAllQuestionsAsObjectArrayIncludingDisabled();
	$code = "<table style='width:100%'><tbody><tr><td style='width:10%'><strong>Question ID</strong></td><td><strong>Question</td><td><strong>Status</strong></td><td><strong>Enable</strong></td><td><strong>Disable</strong></td></tr>";
	while (!empty($questions)) {
		$question = array_pop($questions);
		$code = $code . "<tr>
							<td class='question_id'>$question->question_id</td>
							<td><a href='question.php?question_id=$question->question_id'>$question->question</a></td>
							<td>$question->status</td>
							<td><button class='enableQuestion'>Enable</button></td>
							<td><button class='disableQuestion'>Disable</button>
							</tr>";
	}
	$code = $code . "</tbody></table>";
	echo $code;
}
if (isset($_GET['answers'])) {
	$answer = new answer;
	$answers = $answer->getListOfAllAnswersAsObjectArrayIncludingDisabled();
	$code = "<table style='width:100%'><tbody><tr><td style='width:10%'><strong>Answer ID</strong></td><td><strong>Answer</td><td><strong>Status</strong></td><td><strong>Enable</strong></td><td><strong>Disable</strong></td></tr>";
	while (!empty($answers)) {
		$answer = array_pop($answers);
		$code = $code . "<tr>
							<td class='answer_id'>$answer->answer_id</td>
							<td><a href='answer.php?answer_id=$answer->answer_id'>$answer->answer</a></td>
							<td>$answer->status</td>
							<td><button class='enableAnswer'>Enable</button></td>
							<td><button class='disableAnswer'>Disable</button>
							</tr>";
	}
	$code = $code . "</tbody></table>";
	echo $code;
}
if (isset($_GET['load'])) {
	if (isset($_GET['exam_id'])) {
		$exam = new exam;
		$exam->getFromDB($_GET['exam_id']);
		$code = "	<table style='width:100%'><tbody>
					<tr><td style='width:10%'>Exam ID:</td><td id='exam_id'>$exam->exam_id</td></tr>
					<tr><td>Title:</td><td><input size=50 type='text' id='examTitle' value='$exam->title' /></td></tr>
					<tr><td><button id='editExam'>Edit</button></td><td></td></tr>
					</tbody></table>";
	}
	if (isset($_GET['section_id'])) {
		$section = new section;
		$section->getFromDB($_GET['section_id']);
		$code = "	<table style='width:100%'><tbody>
					<tr><td style='width:10%'>Section ID:</td><td id='section_id'>$section->section_id</td></tr>
					<tr><td>Title:</td><td><input size=50 type='text' id='sectionTitle' value='$section->title' /></td></tr>
					<tr><td><button id='editSection'>Edit</button></td><td></td></tr>
					</tbody></table>";
	}
	if (isset($_GET['question_id'])) {
		$question = new question;
		$question->getFromDB($_GET['question_id']);
		$code = "	<table style='width:100%'><tbody>
					<tr><td style='width:10%'>Question ID:</td><td id='question_id'>$question->question_id</td></tr>
					<tr><td>Question:</td><td><textarea rows='4' cols='100' id='questionQuestion'>$question->question</textarea></td></tr>
					<tr><td><button id='editQuestion'>Edit</button></td><td></td></tr>
					</tbody></table>";
	}
	if (isset($_GET['answer_id'])) {
		$answer = new answer;
		$answer->getFromDB($_GET['answer_id']);
		$code = "	<table style='width:100%'><tbody>
					<tr><td style='width:10%'>Answer ID:</td><td id='answer_id'>$answer->answer_id</td></tr>
					<tr><td>Answer:</td><td><textarea rows='4' cols='100' id='answerAnswer'>$answer->answer</textarea></td></tr>
					<tr><td><button id='editAnswer'>Edit</button></td><td></td></tr>
					</tbody></table>";
	}
	echo $code;
}
if (isset($_GET['edit'])) {
	if (isset($_GET['exam_id']) && isset($_GET['title'])) {
		$exam = new exam;
		$exam->getFromDB($_GET['exam_id']);
		$exam->set_title($_GET['title']);
		$exam->updateInDB();
	}
	if(isset($_GET['section_id']) && isset($_GET['title'])) {
		$section = new section;
		$section->getFromDB($_GET['section_id']);
		$section->set_title($_GET['title']);
		$section->updateSectionInDB();
	}
	if(isset($_GET['question_id']) && isset($_GET['question'])) {
		$question = new question;
		$question->getFromDB($_GET['question_id']);
		$question->set_question($_GET['question']);
		$question->updateQuestionInDB();
	}
	if (isset($_GET['answer_id']) && isset($_GET['answer'])) {
		$answer = new answer;
		$answer->getFromDB($_GET['answer_id']);
		$answer->set_answer($_GET['answer']);
		$answer->updateAnswerInDB();
	}
}

if (isset($_GET['disable'])) {
	if (isset($_GET['exam_id'])) {
		$exam = new exam;
		$exam -> getFromDB($_GET['exam_id']);
		$exam ->disable();
	}
	if (isset($_GET['section_id'])) {
		$section = new section;
		$section -> getFromDB($_GET['section_id']);
		$section -> disable();
	}
	if (isset($_GET['question_id'])) {
		$question = new question;
		$question -> getFromDB($_GET['question_id']);
		$question -> disable();
	}
	if (isset($_GET['answer_id'])) {
		$answer = new answer;
		$answer -> getFromDB($_GET['answer_id']);
		$answer -> disable();
	}
}
if (isset($_GET['enable'])) {
	if (isset($_GET['exam_id'])) {
		$exam = new exam;
		$exam -> getFromDB($_GET['exam_id']);
		$exam ->enable();
	}
	if (isset($_GET['section_id'])) {
		$section = new section;
		$section -> getFromDB($_GET['section_id']);
		$section -> enable();
	}
	if (isset($_GET['question_id'])) {
		$question = new question;
		$question -> getFromDB($_GET['question_id']);
		$question -> enable();
	}
	if (isset($_GET['answer_id'])) {
		$answer = new answer;
		$answer -> getFromDB($_GET['answer_id']);
		$answer -> enable();
	}
}

?>