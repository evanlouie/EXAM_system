<?php

class answerManager {
	
	public $answer_id;
	public $answer;

	function __construct($answer_id, $answer) {
		$this->answer_id = $answer_id;
		$this->answer = $answer;
	}
	public function get_answer_id() {
		return $this->answer_id;
	}
	public function set_answer_id($answer_id) {
		$this->answer_id = $answer_id;
		return TRUE;
	}
	public function get_answer() {
		return $this->answer;
	}
	public function set_answer($answer) {
		$this->answer = $answer;
		return TRUE;
	}
}

?>
