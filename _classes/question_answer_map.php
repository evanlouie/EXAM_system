<?php

class question_answer_map extends master {

	private $sqam_id;
	private $answer_id;

	function __construct() {
		parent::__construct();
	}

	public function get_sqam_id() {
		return $this -> sqam_id;
	}

	public function set_sqam_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> sqam_id = $id;
		return TRUE;
	}

	public function get_answer_id() {
		return $this -> answer_id;
	}

	public function set_answer_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> answer_id = $id;
		return TRUE;
	}

	public function saveToDatabase() {
		if (isset($this -> answer_id) && isset($this -> sqam_id)) {
			$query = "INSERT INTO question_answer_map VALUES (?, ?)";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('ii', $this -> sqam_id, $this -> answer_id);
				if ($stmt -> execute()) {
					return TRUE;
				} else {
					return FALSE;
				}
			} else {
				return FALSE;
			}
		} else
			return FALSE;
	}

	public function deleteFromDatabase() {
		if (isset($this -> answer_id) && isset($this -> sqam_id)) {
			$query = "DELETE FROM question_answer_map WHERE sqam_id = ? AND answer_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('ii', $this -> sqam_id, $this -> answer_id);
				if ($stmt -> execute()) {
					return TRUE;
				}
			}
		} else
			return FALSE;
	}

	public function get_all_answer_id_from_sqam_id($sqam_id) {
		$sqam_id = $this -> mysqli -> escape_string($sqam_id);
		$array = array();
		$query = "
					SELECT
						qam.answer_id
					FROM
						question_answer_map as qam,
						section_question_answer_map as sqam
					WHERE
						? = qam.sqam_id AND
						? = sqam.sqam_id AND
						sqam.answer_id != qam.answer_id";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('ii', $sqam_id, $sqam_id);
			if ($stmt -> execute()) {
				$result = $stmt -> get_result();
				while ($obj = $result -> get_object()) {
					array_push($array, $obj);
				}
			}
		}

		return $array;
	}

}
?>