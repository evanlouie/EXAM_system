<?php

class admin {

	private $user_id;

	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
	}

	public function set_user_id($user_id) {
		$query = "SELECT * FROM user WHERE '$user_id' = user_id";
		$result = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($result) == 0) {
			die("User does not exist, cannot make admin");
		} else {
			$this -> user_id = $user_id;
			return TRUE;
		}
	}

	public function get_user_id() {
		return $this -> user_id;
	}

	public function saveToDB() {
		$query = "SELECT * FROM admin WHERE user_id = '$this->user_id'";
		$result = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($result) == 0) {
			$query = "INSERT INTO admin VALUES ('$this->user_id')";
			mysql_query($query) or die(mysql_error());
		}
		return TRUE;
	}

	public function deleteFromDB() {
		$query = "DELETE FROM admin WHERE user_id = '$this->user_id'";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}

	public function isAdmin($user_id) {
		$query = "SELECT * FROM admin WHERE user_id = '$user_id'";
		$result = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($result) == 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

}
?>
