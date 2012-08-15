<?php

class exam extends master {

	public $exam_id;
	public $title;

	function __construct() {
		parent::__construct();
	}

	public function getFromDB($exam_id) {
		$query = "SELECT * FROM exam WHERE exam_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $exam_id);
			$stmt -> execute();
			$result = $stmt -> get_result();
			if ($result -> num_rows != 0) {
				while ($obj = $result -> fetch_object()) {
					$this -> exam_id = $obj -> exam_id;
					$this -> title = $obj -> title;
				}
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	public function get_exam_id() {
		return $this -> exam_id;
	}

	public function set_exam_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> exam_id = $id;
		return TRUE;
	}

	public function get_title() {
		return $this -> title;
	}

	public function set_title($title) {
		$title = $this -> mysqli -> escape_string($title);
		$this -> title = $title;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this -> exam_id)) {
			die("exam_id is set, object already exists in DB or user illegal operation");
		} else {
			$query = "INSERT INTO exam VALUES (NULL, ?)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('s', $this -> title);
				if ($stmt -> execute()) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}

	public function deleteFromDB() {
		if (!isset($this -> exam_id)) {
			die("exam_id not set, object does not exist in DB or is not currently referencing object in DB");
		} else {
			$query = "DELETE FROM exam WHERE exam_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('i', $this -> exam_id);
				if ($stmt -> execute()) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}

	public function updateInDB() {
		if (!isset($this -> exam_id)) {
			die("exam_id not set, object does not exist in DB or is not currently referencing object in DB");
		} else {
			$query = "UPDATE exam SET title = '$this->title' WHERE exam_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('si', $this -> title, $this -> exam_id);
				if ($stmt -> execute()) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
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
						? = e.exam_id AND
						e.exam_id = esm.exam_id AND
						e.exam_id = esmap.exam_id AND
						esmap.section_id = sqam.section_id AND
						esm.sqam_id = sqam.sqam_id";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> exam_id);
			if ($stmt -> execute() or die($stmt -> error)) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					array_push($array, $obj);
				}
				return $array;
			}
		}
	}

	public function getListOfAllExamsAsObjectArray() {
		$array = array();
		$query = "SELECT * FROM exam";
		$result = $this -> mysqli -> query($query) or die($this -> mysqli -> error);
		while ($obj = $result -> fetch_object()) {
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
						? = e.exam_id AND
						e.exam_id = esm.exam_id AND
						esm.section_id = s.section_id";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> exam_id);
			$stmt -> execute();
			$result = $stmt -> get_result();
			while ($obj = $result -> fetch_object()) {
				array_push($array, $obj);
			}
			return $array;
		}
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

		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> exam_id);
			$stmt -> execute();
			$result = $stmt -> get_result();
			while ($obj = $result -> fetch_object()) {
				array_push($array, $obj);
			}
			return $array;
		}
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
						? = e.exam_id AND
						e.exam_id = esm.exam_id";
		if ($stmt = $this -> mysqli -> prepare($query) or die(mysql_error)) {
			$stmt -> bind_param('i', $exam_id);
			if ($stmt -> execute()) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					$score++;
				}
			}
		}
		return $score;
	}

}
?>