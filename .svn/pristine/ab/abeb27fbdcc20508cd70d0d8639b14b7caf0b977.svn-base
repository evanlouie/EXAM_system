<?php
foreach (glob("../_classes/*.php") as $filename) {
	require "$filename";
}
$user = new user;

if (isset($_GET['create']) && isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['email']) && isset($_GET['password'])) {
	$user -> set_first_name($_GET['first_name']);
	$user -> set_last_name($_GET['last_name']);
	$user -> set_email($_GET['email']);
	$user -> set_password($_GET['password']);
	$user -> saveToDB();

}
if (isset($_GET['delete']) && isset($_GET['user_id'])) {
	$user -> getFromDB($_GET['user_id']);
	$user -> deleteFromDB();
}
if (isset($_GET['edit']) && isset($_GET['user_id']) && isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['email']) && isset($_GET['password'])) {
	$user -> getFromDB($_GET['user_id']);
	$user -> set_first_name($_GET['first_name']);
	$user -> set_last_name($_GET['last_name']);
	$user -> set_email($_GET['email']);
	$user -> set_password($_GET['password']);
	$user -> updateInDB();
}
?>