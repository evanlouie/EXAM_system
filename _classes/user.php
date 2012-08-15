<?php

class user extends master {

	public $user_id;
	private $first_name;
	private $last_name;
	private $email;
	private $password;

	function __construct() {
		parent::__construct();

	}

	public function getFromDB($user_id) {
		$user_id = $this -> mysqli -> escape_string($user_id);
		$query = "SELECT * FROM user WHERE user_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query)) {
			$stmt -> bind_param('i', $user_id);
			if ($stmt -> execute()) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					$this -> email = $obj -> email;
					$this -> first_name = $obj -> first_name;
					$this -> last_name = $obj -> last_name;
					$this -> password = $obj -> password;
					$this -> user_id = $obj -> user_id;
				}
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	public function get_user_id() {
		return $this -> user_id;
	}

	public function set_user_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> user_id = $id;
		return TRUE;
	}

	public function get_first_name() {
		return $this -> first_name;
	}

	public function set_first_name($fname) {
		$fname = $this -> mysqli -> escape_string($fname);
		$this -> first_name = $fname;
		return TRUE;
	}

	public function get_last_name() {
		return $this -> last_name;
	}

	public function set_last_name($lname) {
		$lname = $this -> mysqli -> escape_string($lname);
		$this -> last_name = $lname;
		return TRUE;
	}

	public function get_email() {
		return $this -> email;
	}

	public function set_email($email) {
		$email = $this -> mysqli -> escape_string($email);
		$this -> email = $email;
		return TRUE;
	}

	public function get_password() {
		return $this -> password;
	}

	public function set_password($password) {
		$password = $this -> mysqli -> escape_string($password);
		$this -> password = $password;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this -> user_id)) {
			die("user_id set; object already exists in DB");
		} else {
			$query = "INSERT INTO user VALUES (NULL, ?, ?, ?, ?)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('ssss', $this -> first_name, $this -> last_name, $this -> email, $this -> password);
				return $stmt -> execute();
			}
		}
	}

	public function deleteFromDB() {
		if (!isset($this -> user_id)) {
			die("user_id not set; no object referenced in DB");
		} else {
			$query = "DELETE FROM user WHERE user_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('i', $this -> user_id);
				return $stmt -> execute();
			}
		}
	}

	public function updateInDB() {
		if (!isset($this -> user_id)) {
			die("user_id not set; no object referenced in DB");
		} else {
			$query = "UPDATE user SET first_name = ?, last_name = ?, email = ?, password = ? WHERE user_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query)) {
				$stmt -> bind_param('ssssi', $this -> first_name, $this -> last_name, $this -> email, $this -> password, $this -> user_id);
				return $stmt -> execute();
			}
		}
	}

	public function availableEmail($email) {
		$email = $this -> mysqli -> escape_string($email);
		$query = "SELECT * FROM user WHERE email = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('s', $email);
			if ($stmt -> execute() or die($stmt -> error)) {
				$result = $stmt -> get_result();
				if ($result -> num_rows == 0) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		}
	}

	public function get_user_id_fromDB($email) {
		$email = $this -> mysqli -> escape_string($email);
		$query = "SELECT * FROM user WHERE email = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('s', $email);
			if ($stmt -> execute() or die($stmt -> error)) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					return $obj -> user_id;
				}
			}
		}
	}

	public function getAllAttemptObjects() {
		$attempts = array();
		$query = "	SELECT DISTINCT
						e.title,
						a.score,
						a.timestamp,
						a.attempt_id,
						e.exam_id,
						a.out_of
					FROM
						user as u,
						attempt as a,
						attempt_exam_map as aem,
						exam as e
					WHERE
						? = u.user_id AND
						u.user_id = a.user_id AND
						a.attempt_id = aem.attempt_id AND
						aem.exam_id = e.exam_id
					ORDER BY
						a.attempt_id";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> user_id);
			if ($stmt -> execute() or die($stmt -> error)) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					array_push($attempts, $obj);
				}
			}
		}
		return $attempts;
	}

	public function isPasswordRight($password) {
		$password = $this -> mysqli -> escape_string($password);
		if ($password == $this -> password) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function userExists($email) {
		$email = $this -> mysqli -> escape_string($email);
		$query = "SELECT * FROM user WHERE email = '$email'";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('s', $email);
			if ($stmt -> execute() or die($stmt -> error)) {
				$result = $stmt -> get_result();
				if ($result -> num_rows == 0) {
					return FALSE;
				} else {
					return TRUE;
				}
			}
		}

	}

	public function getAllUserID() {
		$query = "SELECT user_id FROM user";
		$result = $this -> mysqli -> query($query);
		$array = array();
		while ($obj = $result -> fetch_object()) {
			array_push($array, $obj);
		}
		return $array;
	}

	public function deleteUserAndAllInformation() {
		$query = "SELECT * FROM attempt WHERE user_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $this -> user_id);
			if ($stmt -> execute() or die($stmt -> error)) {
				$result = $stmt -> get_result();
				while ($obj = $result -> fetch_object()) {
					$q = "DELETE FROM attempt_sqa_map WHERE attempt_id = ?";
					if ($s = $this -> mysqli -> prepare($q) or die($this -> mysqli -> error)) {
						$s -> bind_param('i', $obj -> attempt_id);
						$s -> execute or die($s -> error);
					}
					$q = "DELETE FROM attempt_exam_map WHERE attempt_id = ?";
					if ($s = $this -> mysqli -> prepare($q) or die($this -> mysqli -> error)) {
						$s -> bind_param('i', $obj -> attempt_id);
						$s -> execute or die($s -> error);
					}
					$q = "DELETE FROM attempt WHERE attempt_id = ?";
					if ($s = $this -> mysqli -> prepare($q) or die($this -> mysqli -> error)) {
						$s -> bind_param('i', $obj -> attempt_id);
						$s -> execute or die($s -> error);
					}
				}
			}
		}
		$q = "DELETE FROM admin WHERE user_id = ?";
		if ($s = $this -> mysqli -> prepare($q) or die($this -> mysqli -> error)) {
			$s -> bind_param('i', $this -> user_id);
			$s -> execute or die($s -> error);
		}
		$q = "DELETE FROM user WHERE user_id = ?";
		if ($s = $this -> mysqli -> prepare($q) or die($this -> mysqli -> error)) {
			$s -> bind_param('i', $this -> user_id);
			$s -> execute or die($s -> error);
		}
	}

}
?>