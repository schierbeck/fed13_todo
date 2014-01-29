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
?>