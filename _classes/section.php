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
		$status = $this -> mysqli -> escape_string($status);
		if ($status == 0 || $status == 1) {
			$this -> status = $status;
			return TRUE;
		} else {
			die("Illegal character used for status, status is either 1 or 0");
		}

	}

	public function saveToDatabase() {
		if (isset($this -> section_id)) {
			die("Section ID is set; either object already exists in DB or user specified ID (which is not allowed)");
		} else if (isset($this -> title) && isset($this -> status)) {
			$query = "INSERT INTO section VALUES (NULL, ?, ?)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('si', $this -> title, $this -> status);
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

	public function enable() {
		$query = "UPDATE section SET status = 1 WHERE section_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> section_id);
			return $stmt -> execute();
		}
	}

	public function disable() {
		$query = "UPDATE section SET status = 0 WHERE section_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> section_id);
			return $stmt -> execute();
		}
	}

	public function getListOfAllSectionsAsObjectArray() {
		$array = array();
		$query = "SELECT * FROM section";
		$result = $this -> mysqli -> query($query) or die($this -> mysqli -> error);
		while ($obj = $result -> fetch_objecT()) {
			array_push($array, $obj);
		}
		return $array;
	}

}
?>