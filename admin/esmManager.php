<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$esm = new exam_section_map;

if (isset($_GET['create']) && isset($_GET['exam_id']) && isset($_GET['section_id'])) {
	$esm -> set_exam_id($_GET['exam_id']);
	$esm -> set_section_id($_GET['section_id']);
	$esm -> saveToDB();
}
if (isset($_GET['delete']) && isset($_GET['exam_id']) && isset($_GET['section_id'])) {
	$esm -> set_exam_id($_GET['exam_id']);
	$esm -> set_section_id($_GET['section_id']);
	$esm -> deleteFromDB();
}
?>