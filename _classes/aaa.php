<?php

class master {
	
	function __construct() {
		mysql_connect("localhost", "root", "") or die(mysql_error());
		mysql_select_db("exam_system") or die(mysql_error());
		$mysqli = new mysqli('localhost', 'root', '', 'exam_system');
		if ($mysqli -> connect_error) {
			die('Connect Error (' . $mysqli -> connect_errno . ') ' . $mysqli -> connect_error);
		}
	}
}

?>