<?php

class question extends master {

	public $question_id;
	public $question;
	public $status;

	function __construct() {
		parent::__construct();
	}

	public function getFromDB($question_id) {
		$question_id = $this -> mysqli -> escape_string($question_id);
		$query = "SELECT * FROM question WHERE question_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('i', $question_id);
			if ($stmt -> execute()) {
				$result = $stmt -> get_result();
				while ($question = $result -> fetch_object()) {
					$this -> question_id = $question -> question_id;
					$this -> question = $question -> question;
				}
			}
		}
	}

	public function get_question_id() {
		return $this -> question_id;
	}

	public function set_question_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> question_id = $id;
	}

	public function get_question() {
		return $this -> question;
	}

	public function set_question($question) {
		$question = $this -> mysqli -> escape_string($question);
		$this -> question = $question;
	}

	public function get_status() {
		return $this -> status;
	}

	public function set_status($status) {
		$this -> status = $this -> mysqli -> escape_string($status);
		return TRUE;
	}

	public function enable() {
		$this -> status = 1;
		$query = "UPDATE question SET status = 1 WHERE question_id = $this->question_id";
		$this -> mysqli -> query($query);
	}

	public function disable() {
		$this -> status = 0;
		$query = "UPDATE question SET status =0 WHERE question_id = $this->question_id";
		$this -> mysqli -> query($query);
	}

	public function saveToDatabase() {
		if (!isset($this -> question)) {
			die("No question text is set");
		} else if (isset($question_id)) {
			die("question_id is set; therefore object must already exist in DB");
		} else {
			$query = "INSERT INTO question VALUES (NULL, ?, 1)";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('s', $this -> question);
				if ($stmt -> execute()) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}

	}

	public function deleteFromDatabase() {
		$query = "DELETE FROM question WHERE question_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('i', $this -> question_id);
			if ($stmt -> execute()) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function updateQuestionInDB() {
		$query = "UPDATE question SET question = ? WHERE question_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('si', $this -> question, $this -> question_id);
			if ($stmt -> execute()) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
		return TRUE;
	}

	public function getListOfAllQuestionsAsObjectArray() {
		$array = array();
		$query = "SELECT * FROM question WHERE status = 1";
		$result = $this -> mysqli -> query($query) or die($this -> mysqli -> error);
		while ($obj = $result -> fetch_object()) {
			array_push($array, $obj);
		}
		return $array;
	}
	public function getListOfAllQuestionsAsObjectArrayIncludingDisabled() {
		$array = array();
		$query = "SELECT * FROM question";
		$result = $this -> mysqli -> query($query) or die($this -> mysqli -> error);
		while ($obj = $result -> fetch_object()) {
			array_push($array, $obj);
		}
		return $array;
	}

}
?>