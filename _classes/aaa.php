<?php

class master {

	function __construct() {
		$this -> mysqli = new mysqli('localhost', 'root', '', 'exam_system');
		if ($this -> mysqli -> connect_error) {
			die('Connect Error (' . $this -> $mysqli -> connect_errno . ') ' . $this -> $mysqli -> connect_error);
		}
	}

	function echoFooter() {
		echo '<p class="footer">Design: <a href="http://www.evanlouie.com"><strong>www.evanlouie.com</strong></a></p>';
	}

}
?>