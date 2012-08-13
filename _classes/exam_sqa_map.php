<?php

class exam_sqa_map {

	private $exam_id;
	private $sqam_id;

	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
	}

	public function get_exam_id() {
		return $this -> exam_id;
	}

	public function set_exam_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> exam_id = $id;
		return TRUE;
	}

	public function get_sqam_id() {
		return $this -> sqam_id;
	}

	public function set_sqam_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> sqam_id = $id;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this->exam_id) && isset($this->sqam_id)) {
			$query = "SELECT * FROM exam_sqa_map WHERE exam_id = $this->exam_id AND sqam_id = $this->sqam_id";
			$result = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($result)>0) {
				die("Exam -> section_qustion_answer mapping already exists");
			}
			$query = "INSERT INTO exam_sqa_map VALUES ('$this->exam_id', '$this->sqam_id')";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		} else
			return FALSE;
	}

	public function deleteFromDB() {
		$query = "DELETE FROM exam_sqa_map WHERE exam_id = '$this->exam_id' AND sqam_id = '$this->sqam_id'";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}

}
?>