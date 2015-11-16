<?php

$connStr = 'sqlite:base.db';
$conn = new PDO($connStr);
	
$surnom = $_POST['surnom'];

$sth=$conn->exec("create table if not exists participants(id integer primary key, surnom text);");

$sth=$conn->exec("INSERT INTO participants(surnom) VALUES('".$surnom."');");

?>
