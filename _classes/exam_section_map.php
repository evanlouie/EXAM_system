<?php

class exam_section_map extends master {

	private $exam_id;
	private $section_id;

	function __construct() {
		parent::__construct();
	}

	public function get_exam_id() {
		return $this -> exam_id;
	}

	public function set_exam_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> exam_id = $id;
		return TRUE;
	}

	public function get_section_id() {
		return $this -> section_id;
	}

	public function set_section_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> section_id = $id;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this -> exam_id) && isset($this -> section_id)) {
			$query = "SELECT * 
						FROM 
							exam_section_map AS esm, 
							exam AS e, 
							section AS s 
						WHERE 
							esm.exam_id = ? AND 
							esm.section_id = ? AND 
							esm.exam_id = e.exam_id AND 
							esm.section_id = s.section_id AND 
							e.status = 1 AND 
							s.status = 1";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('ii', $this -> exam_id, $this -> section_id);
				$stmt -> execute() or die($stmt -> error);
				$result = $stmt -> get_result();
				if ($result -> num_rows > 0) {
					die("Exam - section mapping already exists");
				} else {
					$query = "INSERT INTO exam_section_map VALUES (?, ?)";
					if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
						$stmt -> bind_param('ii', $this -> exam_id, $this -> section_id);
						$stmt -> execute() or die($this -> mysqli -> error);
						return TRUE;
					} else {
						return FALSE;
					}

				}
			}
		}
	}

	public function deleteFromDB() {
		$query = "DELETE FROM exam_section_map WHERE exam_id = ? AND section_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('ii', $this -> exam_id, $this -> section_id);
			$stmt -> execute() or die($stmt -> error);
			return TRUE;
		} else {
			return FALSE;
		}
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
						? = e.exam_id AND
						e.exam_id = esm.exam_id AND
						esm.section_id = s.section_id AND
						s.section_id = ? AND
						s.section_id = sqam.section_id AND
						sqam.sqam_id = esqam.sqam_id AND
						esqam.exam_id = e.exam_id AND
						e.status = 1 AND
						s.status = 1";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('ii', $this -> exam_id, $this -> section_id);
			$stmt -> execute() or die($stmt -> error);
			$result = $stmt -> get_result();
			while ($obj = $result -> fetch_object()) {
				array_push($array, $obj -> question_id);
			}
			return $array;
		}
	}

	public function get_all_non_associated_question_id_as_array() {
		$array = array();
		$query = "	SELECT
						question_id
					FROM
						question
					WHERE
						status = 1 AND
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
												? = e.exam_id AND
												e.exam_id = esm.exam_id AND
												esm.section_id = s.section_id AND
												s.section_id = ? AND
												s.section_id = sqam.section_id AND
												sqam.sqam_id = esqam.sqam_id AND
												esqam.exam_id = e.exam_id
											)";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('ii', $this -> exam_id, $this -> section_id);
			$stmt -> execute() or die($stmt -> error);
			$result = $stmt -> get_result();
			while ($obj = $result -> fetch_object()) {
				array_push($array, $obj -> question_id);
			}
			return $array;
		}
	}

}
?>