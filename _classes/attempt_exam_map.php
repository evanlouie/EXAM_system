<?php

class attempt_exam_map extends master {

	public $attempt_id;
	public $exam_id;

	
	function __construct() {
		parent::__construct();
	}
	
	public function get_attempt_id() {
		return $this -> attempt_id;
	}

	public function set_attempt_id($attempt_id) {
		$attempt_id = $this -> mysqli -> escape_string($attempt_id);
		$this -> attempt_id = $attempt_id;
		return TRUE;
	}

	public function get_exam_id() {
		return $this -> exam_id;
	}

	public function set_exam_id($exam_id) {
		$exam_id = $this -> mysqli -> escape_string($exam_id);
		$this -> exam_id = $exam_id;
		return TRUE;
	}

	public function saveToDB() {
		$query = "INSERT INTO attempt_exam_map VALUES (?, ?)";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('ii', $this -> attempt_id, $this -> exam_id);
			$stmt -> execute() or die($stmt -> error);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deleteFromDB($attempt_id, $exam_id) {
		$attempt_id = $this -> mysqli -> escape_string($attempt_id);
		$exam_id = $this -> mysqli -> escape_string($exam_id);
		$query = "DELETE FROM attempt_exam_map WHERE attempt_id = ? AND exam_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('ii', $attempt_id, $exam_id);
			$stmt -> execute() or die($stmt -> error);
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>