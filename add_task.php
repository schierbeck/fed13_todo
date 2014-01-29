<?php
require 'header.php';
require 'connect.php';

if( !isset( $_POST['add-task'] ) ) { ?>

	<h1>Lägg till uppgift</h1>

	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		Titel:
		<input type="text" name="title">
		Beskrivning:
		<textarea name="content"></textarea>
		Deadline:
		<input type="date" name="deadline">
		<input type="submit" name="add-task" value="Spara">
	</form>
<?php
} else {

	$title = $_POST['title'];
	$content = $_POST['content'];
	$deadline = $_POST['deadline'];
	$finished = 0;

	$add_task_sql = 'INSERT INTO tasks (title, content, deadline, finished) VALUES (?, ?, ?, ?)';
	$stmt = $mysqli->stmt_init();

	if( $stmt->prepare($add_task_sql) ) {

		$stmt->bind_param('sssi', $title, $content, $deadline, $finished);
		$stmt->execute();
		$stmt->close();

		echo 'Uppgift inlagd i databasen!';
	}
	$mysqli->close();
}

require 'footer.php';
?>