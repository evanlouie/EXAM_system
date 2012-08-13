<?php

class attempt_exam_map extends master {

	public $attempt_id;
	public $exam_id;

	public function get_attempt_id() {
		return $this -> attempt_id;
	}

	public function set_attempt_id($attempt_id) {
		$attempt_id = mysql_real_escape_string($attempt_id);
		$this -> attempt_id = $attempt_id;
		return TRUE;
	}

	public function get_exam_id() {
		return $this -> exam_id;
	}

	public function set_exam_id($exam_id) {
		$exam_id = mysql_real_escape_string($exam_id);
		$this -> exam_id = $exam_id;
		return TRUE;
	}

	public function saveToDB() {
		$query = "INSERT INTO attempt_exam_map VALUES ('$this->attempt_id', '$this->exam_id')";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}

	public function deleteFromDB($attempt_id, $exam_id) {
		$attempt_id = mysql_real_escape_string($attempt_id);
		$exam_id = mysql_real_escape_string($exam_id);
		$query = "DELETE FROM attempt_exam_map WHERE attempt_id ='$attempt_id' AND exam_id = '$exam_id'";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}

}
?>