<?php
require 'header.php';
require 'connect.php';

$stmt = $mysqli->stmt_init();

if( isset($_POST['task_complete']) ) {

	$task_complete_sql = 'UPDATE tasks SET finished = 1 WHERE id = ?';

	if( $stmt->prepare($task_complete_sql) ) {
		$stmt->bind_param('i', $_GET['id']);
		$stmt->execute();
	}
	$stmt->close();
	echo 'Uppgiften är nu färdigställd.';

} elseif( isset($_POST['task_delete']) ) {

	$task_delete_sql = 'DELETE FROM tasks WHERE id = ?';

	if( $stmt->prepare($task_delete_sql) ) {
		$stmt->bind_param('i', $_GET['id']);
		$stmt->execute();
	}
	$stmt->close();
	echo 'Uppgiften är nu raderad.';
}
$mysqli->close();

require 'footer.php';
?>