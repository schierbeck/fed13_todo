<?php
/**
 * 	T O D O
 *
 * 	Applikation visar hur man stoppar in, hämtar, uppdaterar och raderar data
 * 	från en MySQL databas med MySQLi och Prepared statements.
 *
 * 	SQL-strängar som applikationen använder sig av:
 *
 * 	Plocka ut ur databasen: 	'SELECT id, title, deadline, finished FROM tasks ORDER BY finished ASC, deadline ASC'
 * 	Stoppa in i databasen: 		'INSERT INTO tasks (title, content, deadline, finished) VALUES (?, ?, ?, ?)'
 * 	Ändra innehåll i kolumn:	'UPDATE tasks SET finished = 1 WHERE id = ?'
 * 	Radera i databasen:			'DELETE FROM tasks WHERE id = ?'
 */

require 'header.php';
require 'connect.php';

$tasks_sql = 'SELECT id, title, deadline, finished FROM tasks ORDER BY finished ASC, deadline DESC';
$stmt = $mysqli->stmt_init();

if( $stmt->prepare($tasks_sql) ) {
	$stmt->bind_result($id, $title, $deadline, $finished);
	$stmt->execute();

	while( mysqli_stmt_fetch($stmt) ) {

		$d_date = strftime('%d', strtotime($deadline) );
		$d_month = strftime('%B', strtotime($deadline) );
		$d_year = strftime('%Y', strtotime($deadline) );

		$status = '';

		if( $finished > 0 ) {
			$status = 'finished';
		} elseif( time() >= strtotime($deadline) ) {
			$status = 'overdue';
		}
		?>

		<div class="task <?php echo $status; ?>">
			<h2><?php echo $title; ?></h2>
			<p>Deadline: <?php echo $d_date . ' ' . $d_month . ' ' . $d_year; ?></p>

			<a href="task.php?id=<?php echo $id; ?>">Se all info</a>
		</div>

	<?php
	}
	$stmt->close();
}
$mysqli->close();

require 'footer.php';
?>