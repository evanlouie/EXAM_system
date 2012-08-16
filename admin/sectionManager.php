<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$section = new section;

if (isset($_GET['create']) && isset($_GET['title']) && isset($_GET['status'])) {
	$section -> set_title($_GET['title']);
	$section -> set_status($_GET['status']);
	$section -> saveToDatabase();
}
if (isset($_GET['delete']) && isset($_GET['section_id'])) {
	$section -> getFromDB($_GET['section_id']);
	$section -> deleteFromDB();
}
if (isset($_GET['edit']) && isset($_GET['title']) && isset($_GET['section_id']) && isset($_GET['status'])) {
	$section -> getFromDB($_GET['section_id']);
	$section -> set_title($_GET['title']);
	$section -> set_status($_GET['status']);
	$section -> updateSectionInDB();
}
if (isset($_GET['getQuestions']) && isset($_GET['section_id'])) {
	$section -> getFromDB($_GET['section_id']);
	$questions = $section -> getAllAssociatedQuestions();
	$questionList = '<select id="questionChosenForSectionQuestionIncorrectAnswer" name="question" style="width: 100%">
	';
	while (!empty($questions)) {
		$obj = array_pop($questions);
		if (isset($_GET['question_id'])) {
			if ($_GET['question_id'] == $obj -> question_id) {
				$questionList = $questionList . "<option value='$obj->question_id' selected='selected'>$obj->question</option>";
			} else {
				$questionList = $questionList . "<option value='$obj->question_id'>$obj->question</option>";
			}
		} else {
			$questionList = $questionList . "<option value='$obj->question_id'>$obj->question</option>";
		}

	}
	$questionList .= "</select>";
	echo $questionList;
}
?>