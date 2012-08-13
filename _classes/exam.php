<?php

class exam extends master {

	public $exam_id;
	public $title;

	public function getFromDB($exam_id) {
		$query = "SELECT * FROM exam WHERE exam_id = '$exam_id'";
		$result = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($result) != 0) {
			while ($obj = mysql_fetch_object($result)) {
				$this -> exam_id = $obj -> exam_id;
				$this -> title = $obj -> title;
			}
		} else {
			return FALSE;
		}

	}

	public function get_exam_id() {
		return $this->exam_id;
	}

	public function set_exam_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> exam_id = $id;
		return TRUE;
	}

	public function get_title() {
		return $this -> title;
	}

	public function set_title($title) {
		$title = mysql_real_escape_string($title);
		$this -> title = $title;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this->exam_id)) {
			die("exam_id is set, object already exists in DB or user illegal operation");
		} else {
			$query = "INSERT INTO exam VALUES (NULL, '$this->title')";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		}
	}

	public function deleteFromDB() {
		if (!isset($this->exam_id)) {
			die("exam_id not set, object does not exist in DB or is not currently referencing object in DB");
		} else {
			$query = "DELETE FROM exam WHERE exam_id = '$this->exam_id'";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		}
	}

	public function updateInDB() {
		if (!isset($this->exam_id)) {
			die("exam_id not set, object does not exist in DB or is not currently referencing object in DB");
		} else {
			$query = "UPDATE exam SET title = '$this->title' WHERE exam_id = '$this->exam_id'";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		}
	}

	public function getAllSQAM() {
		$array = array();
		$query = "
					SELECT
						sqam.sqam_id,
						sqam.section_id,
						sqam.question_id,
						sqam.answer_id,
						sqam.status
					FROM
						exam as e,
						exam_sqa_map as esm,
						section_question_answer_map as sqam,
						exam_section_map as esmap
					WHERE
						'$this->exam_id' = e.exam_id AND
						e.exam_id = esm.exam_id AND
						e.exam_id = esmap.exam_id AND
						esmap.section_id = sqam.section_id AND
						esm.sqam_id = sqam.sqam_id";
		$result = mysql_query($query) or die(mysql_error());
		while ($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}
	
	public function getListOfAllExamsAsObjectArray() {
		$array = array();
		$query = "SELECT * FROM exam";
		$result = mysql_query($query) or die(mysql_error());
		while($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}
	public function getAllIncludedSectionsAsObjectArray() {
		$array = array();	
		$query = "
					SELECT DISTINCT
						s.section_id
					FROm
						exam as e,
						exam_section_map as esm,
						section as s
					WHERE
						'$this->exam_id' = e.exam_id AND
						e.exam_id = esm.exam_id AND
						esm.section_id = s.section_id";
		$result = mysql_query($query) or die(mysql_error());
		while($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}
	
	public function getAllExcludedSectionsAsObjectArray() {
		$array = array();	
		$query = "
					SELECT 
						section_id
					FROM
						section
					WHERE
						section_id NOT IN (
											SELECT 
												s.section_id
											FROm
												exam as e,
												exam_section_map as esm,
												section as s
											WHERE
												'$this->exam_id' = e.exam_id AND
												e.exam_id = esm.exam_id AND
												esm.section_id = s.section_id
										)";
		$result = mysql_query($query) or die(mysql_error());
		while($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}
	
	public function getOutOfScore($exam_id) {
		$exam_id = mysql_real_escape_string($exam_id);
		$score = 0;
		$query = "	SELECT
						*
					FROM
						exam as e,
						exam_sqa_map as esm
					WHERE
						'$exam_id' = e.exam_id AND
						e.exam_id = esm.exam_id";
		$result = mysql_query($query) or die(mysql_error());
		while($obj = mysql_fetch_object($result)) {
			$score++;
		}
		return $score;
	}

}
?>