<?php

class section {

	public $section_id;
	public $title;
	public $status;

	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
	}

	public function getFromDB($section_id) {
		$section_id = mysql_real_escape_string($section_id);
		$query = "SELECT * FROM section WHERE section_id = '$section_id'";
		$result = mysql_query($query);
		while ($section = mysql_fetch_object($result)) {
			$this -> section_id = $section -> section_id;
			$this -> title = $section -> title;
			$this -> status = $section -> status;
		}
	}

	public function get_section_id() {
		return $this -> section_id;
	}

	public function set_section_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> section_id = $id;
		return TRUE;
	}

	public function get_title() {
		return $this -> title;
	}

	public function set_title($title) {
		$title = mysql_real_escape_string($title);
		$this -> title = $title;
		return TRUE;
	}

	public function get_status() {
		return $this -> status;
	}

	public function set_status($status) {
		$status = mysql_real_escape_string($status);
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
			$query = "INSERT INTO section VALUES (NULL, '$this->title', '$this->status')";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		}
	}

	public function updateSectionInDB() {
		$query = "UPDATE section SET title = '$this->title', status = '$this->status' WHERE section_id = '$this->section_id'";
		mysql_query($query) or die(msyql_error());
		return TRUE;
	}

	public function enable() {
		$query = "UPDATE section SET status = 1 WHERE section_id = '$this -> section_id'";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}

	public function disable() {
		$query = "UPDATE section SET status = 0 WHERE section_id = '$this -> section_id'";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}

	public function getListOfAllSectionsAsObjectArray() {
		$array = array();
		$query = "SELECT * FROM section";
		$result = mysql_query($query) or die(mysql_error());
		while ($obj = mysql_fetch_object($result)) {
			array_push($array, $obj);
		}
		return $array;
	}

}
?>