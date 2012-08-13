<?php
class attempt {

	public $attempt_id;
	public $user_id;
	public $score;
	public $timestamp;
	public $status = 0;
	public $outOf = 0;

	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
	}

	public function getFromDB($attempt_id) {
		$attempt_id = mysql_real_escape_string($attempt_id);
		$query = "SELECT * FROM attempt WHERE attempt_id = '$attempt_id'";
		$result = mysql_query($query) or die(mysql_error());
		while ($obj = mysql_fetch_object($result)) {
			$this -> attempt_id = $obj -> attempt_id;
			$this -> score = $obj -> score;
			$this -> timestamp = $obj -> timestamp;
			$this -> user_id = $obj -> user_id;
			$this -> status = $obj -> status;
			$this -> outOf = $obj -> out_of;
		}
	}

	public function get_attempt_id() {
		return $this -> attempt_id;
	}

	public function set_attempt_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> attempt_id = $id;
		return TRUE;
	}

	public function get_user_id() {
		return $this -> user_id;
	}

	public function set_user_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> user_id = $id;
		return TRUE;
	}

	public function get_score() {
		return $this -> score;
	}

	public function set_score($score) {
		$score = mysql_real_escape_string($score);
		$this -> score = $score;
		return TRUE;

	}

	public function get_timestamp() {
		return $this -> timestamp;
	}

	public function set_timestamp($timestamp) {
		$timestamp = mysql_real_escape_string($timestamp);
		$this -> timestamp = $timestamp;
		return TRUE;
	}

	public function enable_attempt() {
		$this -> status = 1;
		return TRUE;
	}

	public function disable_attempt() {
		$this -> status = 0;
		return TRUE;
	}

	public function get_outOf() {
		return $this -> outOf;
	}

	public function set_outOf($outOf) {
		$outOf = mysql_real_escape_string($outOf);
		$this -> outOf = $outOf;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this -> attempt_id)) {
			die("attempt_id set; object already exists in DB");
		} else {
			$query = "INSERT INTO attempt VALUES (NULL, '$this->user_id', '$this->score', NOW(), '$this->status', '$this->outOf')";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		}
	}

	public function deleteFromDB() {
		if (!isset($this -> attempt_id)) {
			die("attempt_id not set; no object referenced in DB");
		} else {
			$query = "DELETE FROM attempt WHERE attemp_id = '$this->attempt_id'";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		}

	}

	public function updateInDB() {
		if (!isset($this -> attempt_id)) {
			die("attempt_id not set; no object referenced in DB");
		} else {
			$query = "UPDATE attempt SET user_id = '$this->user_id', score = '$this->score', timestamp = '$this->timestamp', status = '$this->status', out_of = '$this->outOf' WHERE attempt_id = '$this->attempt_id'";
			mysql_query($query) or die(mysql_error());
			return TRUE;
		}
	}

	public function get_latest_attempt_from_user_id($user_id) {
		$user_id = mysql_real_escape_string($user_id);
		$query = "	SELECT
						*
					FROM
						attempt
					WHERE
						'$user_id' = user_id
					ORDER BY
						attempt_id DESC
					LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		$obj = mysql_fetch_object($result);
		return $obj;
	}

	public function getScore($attempt_id) {
		$attempt_id = mysql_real_escape_string($attempt_id);
		$query = "	SELECT
						a.attempt_id
					FROM
						attempt AS a,
						attempt_sqa_map as asm,
						section_question_answer_map as sqam
					WHERE
						'$attempt_id' = a.attempt_id AND
						a.attempt_id = asm.attempt_id AND
						asm.sqam_id = sqam.sqam_id AND
						asm.answer_id = sqam.answer_id";
		$result = mysql_query($query) or die(mysql_error());
		$rows = mysql_num_rows($result);
		return $rows;
	}

}
?>