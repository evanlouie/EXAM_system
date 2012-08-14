<?php

class admin extends master {

	private $user_id;

	function __construct() {
		parent::__construct();
	}

	public function set_user_id($user_id) {
		$user_id = $this -> mysqli -> real_escape_string($user_id);
		$query = "SELECT * FROM user WHERE ? = user_id";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $user_id);
			$stmt -> execute();
			$stmt -> store_result();
			if ($stmt -> num_rows == 0) {
				die("User does not exist, cannot make admin");
			} else {
				$this -> user_id = $user_id;
			}
		}
	}

	public function get_user_id() {
		return $this -> user_id;
	}

	public function saveToDB() {
		$query = "SELECT * FROM admin WHERE user_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this->user_id);
			$stmt -> execute() or die($stmt -> error);
			$stmt -> store_result();
			if ($stmt -> num_rows == 0) {
				$query = "INSERT INTO admin VALUES (?)";
				$stmt = $this -> mysqli -> prepare($query);
				$stmt -> bind_param('i', $this->user_id);
				$stmt -> execute() or die($stmt -> error);
			}
		}
	}

	public function deleteFromDB() {
		$query = "DELETE FROM admin WHERE user_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param("i", $this->user_id);
			$stmt -> execute();
		}
		return TRUE;
	}

	public function isAdmin($user_id) {
		$user_id = $this -> mysqli -> real_escape_string($user_id);
		$query = "SELECT * FROM admin WHERE user_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $user_id);
			$stmt -> execute();
			$stmt -> store_result();
			if ($stmt -> num_rows == 0) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
}
?>
