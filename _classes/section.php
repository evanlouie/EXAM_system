<?php

class section extends master {

	public $section_id;
	public $title;
	public $status;

	function __construct() {
		parent::__construct();
	}

	public function getFromDB($section_id) {
		$section_id = $this -> mysqli -> escape_string($section_id);
		$query = "SELECT * FROM section WHERE section_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $section_id);
			if ($stmt -> execute()) {
				$result = $stmt -> get_result();
				while ($section = $result -> fetch_object()) {
					$this -> section_id = $section -> section_id;
					$this -> title = $section -> title;
					$this -> status = $section -> status;
				}
			}
		}

	}

	public function get_section_id() {
		return $this -> section_id;
	}

	public function set_section_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> section_id = $id;
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

	public function get_status() {
		return $this -> status;
	}

	public function set_status($status) {
		$this -> status = $this -> mysqli -> escape_string($status);
		return TRUE;
	}

	public function enable() {
		$this -> status = 1;
		$query = "UPDATE section SET status = 1 WHERE section_id = $this->section_id";
		$this -> mysqli -> query($query);
	}

	public function disable() {
		$this -> status = 0;
		$query = "UPDATE section SET status =0 WHERE section_id = $this->section_id";
		$this -> mysqli -> query($query);
	}

	public function saveToDatabase() {
		if (isset($this -> section_id)) {
			die("Section ID is set; either object already exists in DB or user specified ID (which is not allowed)");
		} else if (isset($this -> title) && isset($this -> status)) {
			$query = "INSERT INTO section VALUES (NULL, ?, 1)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('si', $this -> title);
				return $stmt -> execute();
			}
		}
	}

	public function updateSectionInDB() {
		$query = "UPDATE section SET title = ?, status = ? WHERE section_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('sii', $this -> title, $this -> status, $this -> section_id);
			return $stmt -> execute();
		}
	}


	public function getListOfAllSectionsAsObjectArray() {
		$array = array();
		$query = "SELECT * FROM section WHERE section.status = 1";
		$result = $this -> mysqli -> query($query) or die($this -> mysqli -> error);
		while ($obj = $result -> fetch_objecT()) {
			array_push($array, $obj);
		}
		return $array;
	}
	
	public function getListOfAllSectionsAsObjectArrayIncludingDisabled() {
		$array = array();
		$query = "SELECT * FROM section";
		$result = $this -> mysqli -> query($query) or die($this -> mysqli -> error);
		while ($obj = $result -> fetch_objecT()) {
			array_push($array, $obj);
		}
		return $array;
	}
	

	public function getAllAssociatedQuestions() {
		$array = array();
		$query = "SELECT * FROM section_question_answer_map WHERE section_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> section_id);
			if ($stmt -> execute() or die($stmt -> error)) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					$q = 'SELECT * FROM question WHERE question.question_id = ? AND question.status = 1';
					if ($stmt = $this -> mysqli -> prepare($q) or die($this -> mysqli -> error)) {
						$stmt -> bind_param('i', $obj -> question_id);
						if ($stmt -> execute() or die($stmt -> error)) {
							$r = $stmt -> get_result();
							while ($o = $r -> fetch_object()) {
								array_push($array, $o);
							}
						}
					}
				}
			}
		}
		return $array;
	}

}
?>