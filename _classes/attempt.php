<?php
class attempt extends master {

	public $attempt_id;
	public $user_id;
	public $score;
	public $timestamp;
	public $status = 0;
	public $outOf = 0;

	function __constuct() {
		parent::__construct();
	}

	public function getFromDB($attempt_id) {
		$attempt_id = $this -> mysqli -> escape_string($attempt_id);
		$query = "SELECT * FROM attempt WHERE attempt_id = ?";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $attempt_id);
			$stmt -> execute() or die($stmt -> error);
			$result = $stmt -> get_result();
			while ($obj = $result->fetch_object()) {
				$this -> attempt_id = $obj -> attempt_id;
				$this -> score = $obj -> score;
				$this -> timestamp = $obj -> timestamp;
				$this -> user_id = $obj -> user_id;
				$this -> status = $obj -> status;
				$this -> outOf = $obj -> out_of;
			}
		}
	}

	public function get_attempt_id() {
		return $this -> attempt_id;
	}

	public function set_attempt_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> attempt_id = $id;
		return TRUE;
	}

	public function get_user_id() {
		return $this -> user_id;
	}

	public function set_user_id($id) {
		$id = $this -> mysqli -> escape_string($id);
		$this -> user_id = $id;
		return TRUE;
	}

	public function get_score() {
		return $this -> score;
	}

	public function set_score($score) {
		$score = $this -> mysqli -> escape_string($score);
		$this -> score = $score;
		return TRUE;

	}

	public function get_timestamp() {
		return $this -> timestamp;
	}

	public function set_timestamp($timestamp) {
		$timestamp = $this -> mysqli -> escape_string($timestamp);
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
		$outOf = $this -> mysqli -> escape_string($outOf);
		$this -> outOf = $outOf;
		return TRUE;
	}

	public function saveToDB() {
		if (isset($this -> attempt_id)) {
			die("attempt_id set; object already exists in DB");
		} else {
			$query = "INSERT INTO attempt VALUES (NULL, ?, ?, NOW(), ?, ?)";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('iiii', $this -> user_id, $this -> score, $this -> status, $this -> outOf);
				$stmt -> execute() or die($stmt -> error);
				return TRUE;
			}
		}
	}

	public function deleteFromDB() {
		if (!isset($this -> attempt_id)) {
			die("attempt_id not set; no object referenced in DB");
		} else {
			$query = "DELETE FROM attempt WHERE attemp_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('i', $this -> attempt_id);
				$stmt -> execute() or die($stmt -> error);
				return TRUE;
			} else {
				return FALSE;
			}
		}

	}

	public function updateInDB() {
		if (!isset($this -> attempt_id)) {
			die("attempt_id not set; no object referenced in DB");
		} else {
			$query = "UPDATE attempt SET user_id = ?, score = ?, timestamp = '$this->timestamp', status = ?, out_of = ? WHERE attempt_id = ?";
			if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
				$stmt -> bind_param('iiiii', $this -> user_id, $this -> score, $this -> status, $this -> outOf, $this -> attempt_id);
				$stmt -> execute() or die($stmt -> error);
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	public function get_latest_attempt_from_user_id($user_id) {
		$user_id = $this -> mysqli -> escape_string($user_id);
		$query = "	SELECT
						*
					FROM
						attempt
					WHERE
						? = user_id
					ORDER BY
						attempt_id DESC
					LIMIT 1";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $user_id);
			$stmt -> execute();
			$result = $stmt -> get_result();
			$obj = $result -> fetch_object();
			return $obj;
		}
	}

	public function getScore($attempt_id) {
		$attempt_id = $this -> mysqli -> escape_string($attempt_id);
		$query = "	SELECT
						a.attempt_id
					FROM
						attempt AS a,
						attempt_sqa_map as asm,
						section_question_answer_map as sqam
					WHERE
						? = a.attempt_id AND
						a.attempt_id = asm.attempt_id AND
						asm.sqam_id = sqam.sqam_id AND
						asm.answer_id = sqam.answer_id";
		if ($stmt = $this -> mysqli -> prepare($query) or die($this -> mysqli -> error)) {
			$stmt -> bind_param('i', $attempt_id);
			$stmt -> execute() or die($stmt -> error);
			$result = $stmt -> get_result();
			$rows = $result -> num_rows;
			return $rows;
		}
	}

}
?>