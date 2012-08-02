<?php

class examManager {

	public $exam_id;
	public $title;
	public $sqams = array();

	function __construct() {
	}

	public function get_exam_id() {
		return $this -> exam_id;
	}

	public function set_exam_id($exam_id) {
		$this -> exam_id = $exam_id;
		return TRUE;
	}

	public function get_title() {
		return $this -> title;
	}

	public function set_title($title) {
		$this -> title = $title;
		return TRUE;
	}

	public function get_sqams() {
		return $this -> sqams;
	}

	public function set_sqams($sqams) {
		$this -> sqams = $sqams;
		return TRUE;
	}

	public function pushsqam($sqam) {
		array_push($this -> sqams, $sqam);
		return TRUE;
	}

	public function popsqam() {
		$sqam = array_pop($this -> sqams);
		return $sqam;
	}

	public function addQuestionAnswerManagerTosqam($sqam) {
		array_push($this -> sqams, $sqam);
		return TRUE;
	}

}
?>