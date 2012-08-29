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
	$user -> getFromDB($user_id);

} else {
	die("ERROR: user session error, make sure cookies are accepted. Contact admin if error continues");
}
if (!isset($_POST['exam_id'])) {
	die("ERROR: exam not chosen");
}
$exam_id = $_POST['exam_id'];
$e = createExam($exam_id);
$h1 = $e -> get_title();
$html = '';
$e = getExamDividedIntoSections($e);
$attempt = new attempt;
$attempt -> set_user_id($user_id);
$attempt -> set_score(0);
$attempt -> saveToDB();
$a = $attempt -> get_latest_attempt_from_user_id($user_id);
$attempt_id = $a -> attempt_id;
echo "<div id='attempt_id' style='display:none'>$attempt_id</div>";

$_SESSION['attempt_id'] = $attempt_id;
$_SESSION['exam_id'] = $exam_id;

foreach ($e as $section => $sqamArray) {
	$sqam = $sqamArray[0];
	$html .= "<h2><strong>$sqam->sectionTitle</strong></h2><code class='section' id='$section'>";
	$questionCount = 1;
	foreach ($sqamArray as $key => $sqam) {
		$html .= "<code class='question'><div style='display:none'class='answer'></div><form class='question' id='$sqam->question_id'><table><tbody><tr><td style='width:40px'><strong>$questionCount</strong></td><td><p class='questionText'>$sqam->question</p></td></tr>";
		$questionCount++;
		$answers = array();
		//var_dump($sqam);
		
		//Commented out after changing to different answer grabbing function
		//array_push($answers, "<tr><td></td><td><input type='radio' name='answer' value='$sqam->answer_id'/>$sqam->answer</td></tr>"); 
		foreach ($sqam->incorrectAnswers as $answer_id => $answer) {
			$a = "<tr><td></td><td><input type='radio' name='answer' value='$answer_id'/>$answer</td></tr>";
			array_push($answers, $a);
			
		}
		shuffle($answers);
		foreach ($answers as $key => $answer) {
			$html .= $answer;
		}

		$html .= "</tbody></table></form></code>";
	}

	$html .= "<button class='answerButton' style='float:right;'>Lock Answers</button></code>";
}
$html .= "<code><button id='submitExam' style='float:right; width:25%'>Submit Exam</button></code>";
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
			<h1><?php echo $h1 ?><hidden examid="<?php echo $exam_id ?>"></hidden></h1>
			<div id="body">
				<p>
					<strong>Instructions:</strong>
					<ul>
						<li>
							Select appropriate answer from the radio buttons for each corresponding question.
						</li>
						<li>
							After selecting all answers for a section, press the "Lock Answers" button
						</li>
						<li>
							If there is another section, it will be shown to you after locking the current one
						</li>
						<li>
							After all sections are locked, the "Submit Exam" button will become clickable, click to view how you did
						</li>
						<li>
							<strong>Note: </strong>Unanswered questions are assumed to be wrong. So guess if you dont know!
						</li>
						<li>
							<strong>Note: </strong>You must lock the current section to view the next; after locking a section, questions cannot be redone.
						</li>
						<li>
							<strong>Note: </strong>If this page is refreshed, already locked sections will still be recorded and tallied up to create a score.
						</li>
					</ul>
				</p>
				<p>
					Good Luck and may the odds be ever in your favour.
				</p>
				<?php echo $html; ?>
				<code><a href='../user/'>Return to User Panel</a></code>
			</div>

			<?php echoFooter(); ?>
		</div>

	</body>
</html>