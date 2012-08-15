<?php

class exam_sqa_map extends master {

	private $exam_id;
	private $sqam_id;

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

	public function get_sqam_id() {
		return $this -> sqam_id;
	}

	public function set_sqam_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> sqam_id = $id;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this -> exam_id) && isset($this -> sqam_id)) {
			$query = "SELECT * FROM exam_sqa_map WHERE exam_id = ? AND sqam_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('ii', $this -> exam_id, $this -> sqam_id);
				$stmt -> execute();
				$result = $stmt -> get_result();
				if ($result -> num_rows > 0) {
					die("Exam -> section_question_answer mapping already exists");
				} else {
					$query = "INSERT INTO exam_sqa_map VALUES ('$this->exam_id', '$this->sqam_id')";
					if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
						$stmt -> bind_param("ii", $this -> exam_id, $this -> sqam_id);
						if ($stmt -> execute()) {
							return TRUE;
						} else {
							return FALSE;
						}
					}
				}
			}
		}
	}

	public function deleteFromDB() {
		$query = "DELETE FROM exam_sqa_map WHERE exam_id = ? AND sqam_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('ii', $this -> exam_id, $this -> sqam_id);
			if ($stmt -> execute()) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

}
?>