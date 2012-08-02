<?php

class question_answer_map {

	private $sqam_id;
	private $answer_id;

	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
	}

	public function get_sqam_id() {
		return $this -> sqam_id;
	}

	public function set_sqam_id($id) {
		$this -> sqam_id = $id;
		return TRUE;
	}

	public function get_answer_id() {
		return $this -> answer_id;
	}

	public function set_answer_id($id) {
		$this -> answer_id = $id;
		return TRUE;
	}

	public function saveToDatabase() {
		if (isset($this->answer_id) && isset($this->sqam_id)) {
			$query = "INSERT INTO question_answer_map VALUES ('$this->sqam_id', '$this->answer_id')";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		} else
			return FALSE;
	}

	public function deleteFromDatabase() {
		if (isset($this->answer_id) && isset($this->sqam_id)) {
			$query = "DELETE FROM question_answer_map WHERE sqam_id = '$this->sqam_id' AND answer_id = '$this->answer_id'";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		} else
			return FALSE;
	}
	
	public function get_all_answer_id_from_sqam_id($sqam_id) {
		$array = array();
		$query = "
					SELECT
						qam.answer_id
					FROM
						question_answer_map as qam,
						section_question_answer_map as sqam
					WHERE
						'$sqam_id' = qam.sqam_id AND
						'$sqam_id' = sqam.sqam_id AND
						sqam.answer_id != qam.answer_id";
		$result = mysql_query($query) or die(mysql_error());
		while ($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}

}
?>