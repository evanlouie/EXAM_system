<?php

class section_question_answer_map extends master {

	public $sqam_id;
	public $section_id;
	public $question_id;
	public $answer_id = NULL;
	public $status;

	function __construct() {
		parent::__construct();
	}

	public function getFromDB($sqam_id) {
		$sqam_id = $this -> mysqli -> escape_string($sqam_id);
		$query = "SELECT * FROM section_question_answer_map WHERE sqam_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('i', $sqam_id);
			if ($stmt -> execute()) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					$this -> answer_id = $obj -> answer_id;
					$this -> question_id = $obj -> question_id;
					$this -> section_id = $obj -> section_id;
					$this -> sqam_id = $obj -> sqam_id;
					$this -> status = $obj -> status;
					return TRUE;
				}
			} else
				return FALSE;
		} else
			return FALSE;
	}

	public function get_sqam_id() {
		return $this -> sqam_id;
	}

	public function set_sqam_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> sqam_id = $id;
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

	public function get_question_id() {
		return $this -> question_id;
	}

	public function set_question_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> question_id = $id;
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

	public function get_status() {
		return $this -> status;
	}

	public function set_status($status) {
		$status = $this -> mysqli -> escape_string($status);
		if ($status == 1 || $status == 0) {
			$this -> status = $status;
			return TRUE;
		} else
			return FALSE;
	}

	public function saveToDatabase() {
		if (isset($sqam_id)) {
			die("sqam_id is set; sqam_id is not user defined; object must already exist in DB, or illegal user operation");
		} else {
			$query = "SELECT * FROM section_question_answer_map WHERE section_id = ? AND question_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('ii', $this -> section_id, $this -> question_id);
				if ($stmt -> execute()) {
					$result = $stmt -> get_result();
					if ($result -> num_rows > 0) {
						die("This section already has this question in it; a section can only have a question once!");
					} else {
						$query = "INSERT INTO section_question_answer_map VALUES (NULL, ?, ?, ?, ?)";
						if ($stmt = $this -> mysqli -> prepare($query)) {
							$stmt -> bind_param('iiii', $this -> section_id, $this -> question_id, $this -> answer_id, $this -> status);
							if ($stmt -> execute()) {
								return TRUE;
							}
						}
					}
				}
			}
		}
	}

	public function deleteFromDB() {
		if (!isset($sqam_id)) {
			die("sqam_id not set; object does not exist in DB or not currently referencing active object in DB");
		} else {
			$query = "DELETE FROM section_question_answer_map WHERE sqam_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('i', $this -> sqam_id);
				if ($stmt -> execute()) {
					return TRUE;
				} else
					return FALSE;

			} else
				return FALSE;
		}
	}

	public function updateInDB() {
		$query = "	UPDATE section_question_answer_map 
					SET 
						section_id = ?, 
						question_id = ?, 
						answer_id = ?, 
						status = ? 
					WHERE
						section_id = ? AND
						question_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('iiiiii', $this -> section_id, $this -> question_id, $this -> answer_id, $this -> status, $this -> section_id, $this -> question_id);
			return $stmt -> execute();
		}
	}

	public function get_sqam_id_from_section_and_question($section_id, $question_id) {
		$section_id = $this -> mysqli -> escape_string($section_id);
		$question_id = $this -> mysqli -> escape_string($question_id);
		$query = "SELECT * FROM section_question_answer_map WHERE section_id = ? AND question_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('ii', $section_id, $question_id);
			if ($stmt -> execute()) {
				$result = $stmt -> get_result();
				$sqam_id = -1;
				while ($obj = $result -> fetch_object()) {
					$sqam_id = $obj -> sqam_id;
				}
				return $sqam_id;
			}
		}
	}

	public function getAllAssociatedAnswersAsObjectArray() {
		$array = array();
		if (isset($this -> answer_id)) {
			$query = "	SELECT DISTINCT
							a.answer_id,
							a.answer
						FROM
							section_question_answer_map as sqam,
							answer as a,
							question_answer_map as qam
						WHERE
							'$this->answer_id' = a.answer_id OR
							('$this->sqam_id' = qam.sqam_id AND
							qam.answer_id = a.answer_id)";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('ii', $this -> answer_id, $this -> sqam_id);
				if ($stmt -> execute()) {
					$result = $stmt -> get_result();
					while ($obj = $result -> fetch_object()) {
						array_push($array, $obj);
					}
				}
			}
		}
		return $array;
	}

	public function getAllIncorrectAnswersAsObjectArray() {
		$array = array();
		if (isset($this -> answer_id)) {
			$query = "	SELECT DISTINCT
							a.answer_id,
							a.answer
						FROM
							section_question_answer_map as sqam,
							answer as a
						WHERE
							'$this->answer_id' != a.answer_id";
		} else {
			$query = "SELECT * FROM answer";
		}

		$result = mysql_query($query) or die(mysql_error());
		while ($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}

	public function getAllIncludedIncorrectAnswersAsObjectArray() {
		$array = array();
		$query = "
					SELECT
						a.answer_id,
						a.answer
					FROM
						section_question_answer_map as sqam,
						question_answer_map as qam,
						answer as a
					WHERE
						'$this->sqam_id' = sqam.sqam_id AND
						sqam.sqam_id = qam.sqam_id AND
						qam.answer_id = a.answer_id AND
						a.answer_id != '$this->answer_id'";
		$result = mysql_query($query) or die(mysql_error());
		while ($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}

	public function getAllExcludedIncorrectAnswersAsObjectArray() {
		$array = array();
		$query = "
					SELECT
						answer_id
					FROM
						answer
					WHERE
						answer_id NOT IN (	SELECT
												answer_id
											FROM
												question_answer_map
											WHERE
												sqam_id = '$this->sqam_id'	) AND
						answer_id NOT IN ( SELECT
												answer_id
											FROM
												section_question_answer_map
											WHERE
												sqam_id = '$this->sqam_id'	)";
		$result = mysql_query($query) or die(mysql_error());
		while ($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}

}
?>