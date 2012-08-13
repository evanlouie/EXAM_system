<?php

class exam_section_map {

	private $exam_id;
	private $section_id;

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

	public function get_section_id() {
		return $this -> section_id;
	}

	public function set_section_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> section_id = $id;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this->exam_id) && isset($this->section_id)) {
			$query = "SELECT * FROM exam_section_map WHERE exam_id = $this->exam_id AND section_id = $this->section_id";
			$result = mysql_query($query) or die(mysql_error());
			if (mysql_num_rows($result)>0) {
				die("Exam - section mapping already exists");
			}
			$query = "INSERT INTO exam_section_map VALUES ('$this->exam_id', '$this->section_id')";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		} else
			return FALSE;
	}

	public function deleteFromDB() {
		$query = "DELETE FROM exam_section_map WHERE exam_id = '$this->exam_id' AND section_id = '$this->section_id'";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}
	
	public function get_all_associated_question_id_as_array() {
		$array = array();
		$query = "	SELECT 
						sqam.question_id
					FROM
						exam as e,
						exam_section_map as esm,
						section as s,
						exam_sqa_map as esqam,
						section_question_answer_map as sqam
					WHERE
						'$this->exam_id' = e.exam_id AND
						e.exam_id = esm.exam_id AND
						esm.section_id = s.section_id AND
						s.section_id = '$this->section_id' AND
						s.section_id = sqam.section_id AND
						sqam.sqam_id = esqam.sqam_id AND
						esqam.exam_id = e.exam_id";
		$result = mysql_query($query) or die(mysql_error());
		while($obj = mysql_fetch_object($result)) {
			array_push($array, $obj->question_id);
		}
		return $array;
	}
	
	public function get_all_non_associated_question_id_as_array() {
		$array = array();
		$query = "	SELECT
						question_id
					FROM
						question
					WHERE
						question_id NOT IN (
											SELECT 
												sqam.question_id
											FROM
												exam as e,
												exam_section_map as esm,
												section as s,
												exam_sqa_map as esqam,
												section_question_answer_map as sqam
											WHERE
												'$this->exam_id' = e.exam_id AND
												e.exam_id = esm.exam_id AND
												esm.section_id = s.section_id AND
												s.section_id = '$this->section_id' AND
												s.section_id = sqam.section_id AND
												sqam.sqam_id = esqam.sqam_id AND
												esqam.exam_id = e.exam_id
											)";
		$result = mysql_query($query) or die(mysql_error());
		while($obj = mysql_fetch_object($result)) {
			array_push($array, $obj->question_id);
		}
		return $array;
	}

}
?>