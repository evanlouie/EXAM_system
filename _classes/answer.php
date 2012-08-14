<?php

class answer extends master {

	public $answer_id;
	public $answer;

	function __construct() {
		parent::__construct();
	}

	public function getFromDB($answer_id) {
		$answer_id = $this -> mysqli -> real_escape_string($answer_id);
		$query = "SELECT * FROM answer WHERE answer_id = '$answer_id'";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> execute();
			$result = $stmt -> get_result();
			while ($answer = $result -> fetch_object()) {
				$this -> answer_id = $answer -> answer_id;
				$this -> answer = $answer -> answer;
			}
		}
	}

	public function get_answer_id() {
		return $this -> answer_id;
	}

	public function set_answer_id($id) {
		$id = $this -> mysqli -> real_escape_string($id);
		$this -> answer_id = $id;
		return TRUE;
	}

	public function get_answer() {
		return $this -> answer;
	}

	public function set_answer($answer) {
		$answer = $this -> mysqli -> real_escape_string($answer);
		$this -> answer = $answer;
		return TRUE;
	}

	public function saveToDatabase() {
		if (!isset($this -> answer)) {
			die("No answer text is set");
		} else if (isset($this -> answer_id)) {
			die("answer_id is set; therefore object must already exist in DB");
		} else {
			$query = "INSERT INTO answer VALUES (NULL, ?)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param("s", $this -> answer);
				$stmt -> execute() or die($stmt -> error);
				return TRUE;
			}
		}
	}

	public function deleteFromDatabase() {
		$query = "DELETE FROM answer WHERE answer_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param("i", $this -> answer_id);
			$stmt -> execute() or die($stmt -> error);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function updateAnswerInDB() {
		$query = "UPDATE answer SET answer = ? WHERE answer_id = ?";
		if ($stmt = $this->mysqli->prepare($query) or die($this->mysqli->error)) {
			$stmt->bind_param("si", $this->answer, $this->answer_id);
			$stmt->execute() or die($this->mysqli->error);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getListOfAllAnswersAsObjectArray() {
		$query = "SELECT * FROM answer";
		$result = $this->mysqli->query($query);
		$array = array();
		while ($obj = $result->fetch_object()) {
			array_push($array, $obj);
		}
		return $array;
	}

}
?>