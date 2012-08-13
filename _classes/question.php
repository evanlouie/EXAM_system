<?php

class question {

	public $question_id;
	public $question;

	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
	}

	public function getFromDB($question_id) {
		$question_id = mysql_real_escape_string($question_id);
		$query = "SELECT * FROM question WHERE question_id = '$question_id'";
		$result = mysql_query($query);
		while ($question = mysql_fetch_object($result)) {
			$this -> question_id = $question -> question_id;
			$this -> question = $question -> question;
		}
	}

	public function get_question_id() {
		return $this -> question_id;
	}

	public function set_question_id($id) {
		$id = mysql_real_escape_string($id);
		$this -> question_id = $id;
	}

	public function get_question() {
		return $this -> question;
	}

	public function set_question($question) {
		$question = mysql_real_escape_string($question);
		$this -> question = $question;
	}

	public function saveToDatabase() {
		if (!isset($this -> question)) {
			die("No question text is set");
		} else if (isset($question_id)) {
			die("question_id is set; therefore object must already exist in DB");
		} else {
			$query = "INSERT INTO question VALUES (NULL, '$this->question')";
			mysql_query($query) or die(mysql_error());
		}

	}

	public function deleteFromDatabase() {
		$query = "DELETE FROM question WHERE question_id = '$this->question_id'";
		mysql_query($query) or die(mysql_error());
		return TRUE;
	}

	public function updateQuestionInDB() {
		$query = "UPDATE question SET question = '$this->question' WHERE question_id = '$this->question_id'";
		mysql_query($query) or die(msyql_error());
		return TRUE;
	}
	
	public function getListOfAllQuestionsAsObjectArray() {
		$array = array();
		$query = "SELECT * FROM question";
		$result = mysql_query($query) or die(mysql_error());
		while($obj = mysql_fetch_object($result)){
			array_push($array, $obj);
		}
		return $array;
	}
	

}
?>