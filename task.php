<?php

require 'header.php';
require 'connect.php';

if( isset($_GET['id']) ) {

	$task_sql = 'SELECT * FROM tasks WHERE id = ?';
	$stmt = $mysqli->stmt_init();

	if( $stmt->prepare($task_sql) ) {
		$stmt->bind_param('i', $_GET['id']);
		$stmt->bind_result($id, $title, $content, $added, $deadline, $finished);
		$stmt->execute();

		while( mysqli_stmt_fetch($stmt) ) {

			$added = strftime('%A %d %B %Y', strtotime($added) );
			$d_date = strftime('%d', strtotime($deadline) );
			$d_month = strftime('%B', strtotime($deadline) );
			$d_year = strftime('%Y', strtotime($deadline) );
			$status = '';

			if( $finished > 0 ) {
				$status = 'finished';
			} elseif( time() >= strtotime($deadline) ) {
				$status = 'overdue';
			}?>

			<h1><?php echo $title; ?></h1>
			<small>Inlagd: <?php echo $added; ?></small>
			<p><?php echo $content; ?></p>

			<div class="task <?php echo $status; ?>">
				<small>Deadline: <?php echo $d_date . ' ' . $d_month . ' ' . $d_year; ?></small>

			<form action="change_task.php?id=<?php echo $id; ?>" method="post">

				<?php if( $status === 'finished') { ?>
					<p>Uppgiften är anmäld som färdig.</p>

				<?php
				} else { ?>
					<p>Uppgiften är INTE anmäld som färdig.</p>
					<input type="submit" name="task_complete" value="Färdigställ uppgiften">
				<?php
				} ?>

					<input type="submit" name="task_delete" value="Radera uppgiften">

			</form>

		</div>

		<?php
		}
		$stmt->close();
	}
	$mysqli->close();
}

require 'footer.php';
?>