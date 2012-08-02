<?php

class sectionQuestionAnswerManager {

	public $question_id;
	public $question;
	public $answer_id;
	public $answer;
	public $sectionTitle;
	public $section_id;
	public $incorrectAnswers = array();

	function __construct() {
	}

	public function get_question_id() {
		return $this -> question_id;
	}

	public function set_question_id($question_id) {
		$this -> question_id = $question_id;
		return TRUE;
	}

	public function get_question() {
		return $this -> question;
	}

	public function set_question($question) {
		$this -> question = $question;
		return TRUE;
	}

	public function get_answer_id() {
		return $this -> answer_id;
	}

	public function set_answer_id($answer_id) {
		$this -> answer_id = $answer_id;
		return TRUE;
	}

	public function get_answer() {
		return $this -> answer;
	}

	public function set_answer($answer) {
		$this -> answer = $answer;
		return TRUE;
	}

	public function get_sectionTitle() {
		return $this->sectionTitle;
	}
	
	public function set_sectionTitle($sectionTitle) {
		$this->sectionTitle = $sectionTitle;
		return TRUE;
	}
	
	public function get_section_id() {
		return $this->section_id;
	}
	
	public function set_section_id($section_id) {
		$this->section_id = $section_id;
		return TRUE;
	}
	public function get_incorrectAnswers() {
		return $this -> incorrectAnswers;
	}

	public function set_incorrectAnswers($ia) {
		$this -> incorrectAnswers = $ia;
		return TRUE;
	}

	public function pushIncorrectAnswer($answer) {
		array_push($this -> incorrectAnswers, $answer);
		return TRUE;
	}

	public function popIncorrectAnswer() {
		return array_pop($this -> incorrectAnswers);
	}
	
	public function addToIncorrectAnswers($answer_id, $answer) {
		$this->incorrectAnswers[$answer_id] = $answer;
		return TRUE;
	}

}
?>
