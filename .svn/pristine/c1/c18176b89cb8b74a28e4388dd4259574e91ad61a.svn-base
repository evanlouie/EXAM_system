<?php
foreach (glob("../../_classes/*.php") as $filename) {
	require "$filename";
}

$attempt = new attempt;

if (isset($_GET['enable']) && isset($_GET['attempt_id'])) {
	$attempt->getFromDB($_GET['attempt_id']);
	$attempt->enable_attempt();
	$score = $attempt->getScore($_GET['attempt_id']);
	$attempt->set_score($score);
	$attempt->updateInDB();
}
?>