<?php

class master {

	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
		$this -> mysqli = new mysqli('localhost', 'root', '', 'exam_system');
		if ($this -> mysqli -> connect_error) {
			die('Connect Error (' . $this -> $mysqli -> connect_errno . ') ' . $this -> $mysqli -> connect_error);
		}
	}

}
?>