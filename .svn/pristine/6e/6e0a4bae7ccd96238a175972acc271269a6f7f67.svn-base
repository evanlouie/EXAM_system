<?php

class sectionManager {

	public $section_id;
	public $title;
	public $questions = array();

	function __construct($section_id, $title) {
		$this -> section_id = $section_id;
		$this -> title = $title;
	}

	public function get_section_id() {
		return $this -> section_id;
	}

	public function set_section_id($section_id) {
		$this -> section_id = $section_id;
		return TRUE;
	}

	public function get_title() {
		return $this -> title;
	}

	public function set_title($title) {
		$this -> title = $title;
		return TRUE;
	}

	public function get_questions() {
		return $this -> questions;
	}

	public function set_questions($questions) {
		$this -> questions = $questions;
		return TRUE;
	}

	public function addQuestoin($questions) {
		array_push($this -> questions, $questions);
		return TRUE;
	}

	public function popQuestion() {
		$questions = array_pop($this -> questions);
		return $questions;
	}

}
?>