<?php
foreach (glob ( "../../_classes/*.php" ) as $filename) {
	require "$filename";
}

if (isset($_GET['user_id']) && isset($_GET['load'])) {
	$user = new user();
	$admin = new admin();
	$user -> getFromDB($_GET['user_id']);
	$personalInfo = '';
	$personalInfo .= "<form action='index.php' method='post'>
						<table>
							<tbody>
								<tr>
									<td>First Name:</td>
									<td><input type='text' name='fname' value='" . $user -> get_first_name() . "' /></td>
									<td>Last Name:</td>
									<td><input type='text' name='lname' value='" . $user -> get_last_name() . "'/></td>
								</tr>
								<tr>
									<td>Email:</td>
									<td><input type='text' name='email' value='" . $user -> get_email() . "' /></td>
									<td>Password:</td>
									<td><input type='password' name='password' value='" . $user -> get_password() . "' /></td>
								</tr>
								<tr>
									<td>Admin:</td>";
	if ($admin -> isAdmin($user -> user_id)) {
		$personalInfo .= "<td><input type='checkbox' name='admin' checked /></td>";
	} else {
		$personalInfo .= "<td><input type='checkbox' name='admin'/></td>";
	}
	$personalInfo .= "<td><input type='hidden' name='user_id' value='" . $user -> get_user_id() . "' /></td>
									<td><input type='submit' name='updateUser' style='float:right' value='Update Info' /></td>
								</tr>
							</tbody>
						</table></form>
						<button class='deleteUser'>Delete User</button>
						<button class='deleteAllAttemptsButton'>Delete All Attempts</button>";
	echo $personalInfo;
}
if (isset($_GET['user_id']) && isset($_GET['loadAttempts'])) {
	$user = new user();
	$exam = new exam();
	$user -> getFromDB($_GET['user_id']);
	$attempts = $user -> getAllAttemptObjects();
	if (empty($attempts)) {
		$code = "No past exams taken";
		// } else {
		// $code = "	<table style='width:100%'>
		// <tbody>
		// <tr>
		// <td style='width:10%'><strong>Attempt ID</strong></td>
		// <td style='width:40%'><strong>Exam</strong></td>
		// <td><strong>Score</strong></td>
		// <td><strong>Out Of</strong></td>
		// <td><strong>Date</strong></td>
		// <td><strong>Update</strong></td>
		// </tr>";
		// while ( ! empty ( $attempts ) ) {
		// $attempt = array_pop ( $attempts );
		// $code = $code . "	<tr id='$attempt->attempt_id'>
		// <td class='attempt_id'><a href='../../attempt?attempt_id=$attempt->attempt_id'>$attempt->attempt_id</a></td>
		// <td class='exam_title'>$attempt->title</td>
		// <td><input size=1 type='text' class='score' value=$attempt->score /></td>
		// <td><input size=1 type='text' class='outOf' value='" . $exam->getOutOfScore ( $attempt->exam_id ) . "'/></td>
		// <td class='timestamp'>$attempt->timestamp</td>
		// <td><button class='updateAttempt'>Update</button></td>
		// </tr>";
		// }
		// $code = $code . "</tbody></table>";
		// }
	} else {
		$code = "	<table style='width:100%'>
					<tbody>
						<tr>
							<td style='width:10%'><strong>Attempt ID</strong></td>
							<td style='width:40%'><strong>Exam</strong></td>
							<td><strong>Score</strong></td>
							<td><strong>Out Of</strong></td>
							<td><strong>Date</strong></td>
							<td><strong>Delete</strong</td>
						</tr>";
		while (!empty($attempts)) {

			$attempt = array_pop($attempts);
			$a = new attempt;
			$a -> getFromDB($attempt -> attempt_id);
			$code = $code . "	<tr id='$attempt->attempt_id'>
								<td class='attempt_id'><a href='../../attempt?attempt_id=$attempt->attempt_id' target='_blank'>$attempt->attempt_id</a></td>
								<td class='exam_title'>$attempt->title</td>
								<td class='score'>$attempt->score</td>
								<td class='outOf'>" . $a->get_OutOfScore(). "</td>
								<td class='timestamp'>$attempt->timestamp</td>
								<td class='deleteAttemptCell'><button class='deleteAttemptButton'>Delete</button></td>
							</tr>";
		}
		$code = $code . "</tbody></table>";
	}
	echo $code;
}

if (isset($_GET['edit'])) {
	if (isset($_GET['attempt_id']) && isset($_GET['score']) && isset($_GET['outOf'])) {
		$attempt = new attempt();
		$attempt -> getFromDB($_GET['attempt_id']);
		$attempt -> set_score($_GET['score']);
		$attempt -> set_outOf($_GET['outOf']);
		var_dump($_GET['score']);
		var_dump($attempt);
		$attempt -> updateInDB();
		echo "success";
	}
}

if (isset($_GET['delete']) && isset($_GET['user_id'])) {
	$user = new user();
	$user -> getFromDB($_GET['user_id']);
	$user -> deleteUserAndAllInformation();
}

if (isset($_GET['delete']) && isset($_GET['attempt_id'])) {
	$attempt = new attempt;
	$attempt -> getFromDB($_GET['attempt_id']);
	$attempt -> deleteAttempt();
}
if (isset($_GET['deleteAttempts']) && isset($_GET['user_id'])) {
	$user = new user;
	$user -> getFromDB($_GET['user_id']);
	$user -> deleteAllUserAttempts();
}
?>