<?php

class attempt_sqa_map extends master {

	public $attempt_id;
	public $sqam_id;
	public $answer_id;
	
	function __construct() {
		parent::__construct();
	}

	public function get_attempt_id() {
		return $this -> attempt_id;
	}

	public function set_attempt_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> attempt_id = $id;
		return TRUE;
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

	public function saveToDB() {
		if (isset($this -> answer_id) && isset($this -> attempt_id) && isset($this -> sqam_id)) {
			$query = "INSERT INTO attempt_sqa_map VALUES (?, ?, ?)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('iii', $this -> attempt_id, $this -> sqam_id, $this -> answer_id);
				$stmt -> execute() or die($stmt -> error);
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function deleteFromDB() {
		$query = "DELETE FROM attempt_sqa_map WHERE attempt_id = ? AND sqam_id = ? AND answer_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('iii', $this -> attempt_id, $this -> sqam_id, $this -> answer_id);
			$stmt -> execute() or die($stmt -> error);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function saveToDBwithNULLAnswer() {
		if (!isset($this -> answer_id) && isset($this -> attempt_id) && isset($this -> sqam_id)) {
			$query = "INSERT INTO attempt_sqa_map VALUES (?, ?, NULL)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('ii', $this -> attempt_id, $this -> sqam_id);
				$stmt -> execute() or die($stmt -> error);
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function getAttemptedAnswersAsOjectArray($attempt_id) {
		$attempt_id = $this -> mysqli -> escape_string($attempt_id);
		$array = array();
		$query = "SELECT * FROM attempt_sqa_map, attempt WHERE attempt.status = 1 AND attempt.attempt_id = attempt_sqa_map.attempt_id AND attempt_sqa_map.attempt_id = attempt_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $attempt_id);
			$stmt -> execute() or die($stmt -> error);
			$result = $stmt -> get_result();
			while ($obj = $result -> fetch_object()) {
				array_push($array, $obj);
			}
			return $array;
		}
	}

}
?>