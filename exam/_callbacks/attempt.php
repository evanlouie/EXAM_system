<?php
foreach (glob("../../_classes/*.php") as $filename) {
	require "$filename";
}

if (isset($_GET['outOf']) && isset($_GET['attempt_id'])) {
	$attempt = new attempt;
	$attempt -> getFromDB($_GET['attempt_id']);
	$attempt -> set_outOf($_GET['outOf']);
	$attempt -> updateInDB();
}
if (isset($_GET['score']) && isset($_GET['attempt_id'])) {
	$attempt = new attempt;
	$attempt -> getFromDB($_GET['attempt_id']);
	$attempt -> set_score($_GET['score']);
	$attempt -> updateInDB();
}
?>