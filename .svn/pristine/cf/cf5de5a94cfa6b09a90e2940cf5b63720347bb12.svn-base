<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
foreach (glob("_examClasses/*.php") as $filename) {
	require "$filename";
}
foreach (glob("_functions/*.php") as $filename) {
	require "$filename";
}
require "../_functions/functions.php";
session_start();
if (isset($_SESSION['user_id'])) {
	$user_id = $_SESSION['user_id'];
	$user = new user;
	$user->getFromDB($user_id);
} else {
	die("ERROR: user session error, make sure cookies are accepted. Contact admin if error continues");
}

$attempt_id = 0;
if(isset($_GET['attempt_id'])) {
	$attempt_id = $_GET['attempt_id'];
} else {
	die('No Attempt ID specified');
}
$h1 = "Attempt $attempt_id";
$html = '';

$attempt = new attempt_sqa_map();
$attemptedAnswers = $attempt->getAttemptedAnswersAsOjectArray($attempt_id);
foreach($attemptedAnswers as $key => $attempt_sqa_map) {
	$sqam = new section_question_answer_map();
	$sqam->getFromDB($attempt_sqa_map->sqam_id);
	$attempt_sqa_map->actual_answer_id = $sqam->get_answer_id();
	$attempt_sqa_map->section_id = $sqam->get_section_id();
	$answer = new answer();
	$answer->getFromDB($attempt_sqa_map->answer_id);
	$attempt_sqa_map->answer_text = $answer->get_answer();
	$answer->getFromDB($attempt_sqa_map->actual_answer_id);
	$attempt_sqa_map->actual_answer_text = $answer->get_answer();
	$question = new question();
	$question->getFromDB($sqam->question_id);
	$attempt_sqa_map->question=$question->get_question();
	$section = new section();
	$section->getFromDB($sqam->section_id);
	$attempt_sqa_map->section_title = $section->get_title();
}

$questionAnswers = array();
foreach($attemptedAnswers as $key => $attempt_sqa_map) {
	if(!isset($questionAnswers[$attempt_sqa_map->section_id])) {
		$questionAnswers[$attempt_sqa_map->section_id] = array();
	}
	array_push($questionAnswers[$attempt_sqa_map->section_id], $attempt_sqa_map);
	$attempt_sqa_map->section_id["title"] = $attempt_sqa_map->section_title;
}


foreach($questionAnswers as $section_id => $sectionArray) {
	$qNumber = 1;
	$section = new section();
	$section->getFromDB($section_id);
	$section_title = $section->get_title();
	$html .= "<code class='section' id='$section_id'><strong>$section_title</strong>";
	foreach($sectionArray as $key => $questionAnswer) {
		if ($questionAnswer->answer_id == $questionAnswer->actual_answer_id) {
			$html .= "<code class='question' style='background-color:#B7F5B7'>";
		} else {
			$html .= "<code class='question' style='background-color:#F8A7A7'>";
		}
		$html .= "	
						<table>
							<tbody>
								<tr><td>$qNumber.</td><td>$questionAnswer->question</td></tr>
								<tr><td></td><td><strong>Given Answer:</strong></td></tr>
								<tr><td></td><td>$questionAnswer->answer_text</td></tr>
								<tr><td></td><td><strong>Actual Answer:</strong></td></tr>
								<tr><td></td><td>$questionAnswer->actual_answer_text</td></tr>
							</tbody>
						</table>
					</code>";
		$qNumber++;
	}
	
	$html .= "</code>";

}

?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>EXAM System</title>
	<link rel="stylesheet" type="text/css" href="../_css/styles.css"/>
	<script type="text/javascript" src="../_script/jquery.js"></script>
	<script type="text/javascript" src="_scripts/exam.js"></script>
</head>
<body>

<div id="container">
	<h1><?php echo $h1 ?></h1>
	<div id="body">
		<?php echo $html; ?>
		<code><a href='../user/'>Return to User Panel</a></code>
	</div>


	<?php echoFooter(); ?>
</div>

</body>
</html>