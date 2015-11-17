<?php


$connStr = 'sqlite:base.db';
$conn = new PDO($connStr);
	
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$pseudo = $_POST['pseudo'];
$photo = "photos/".$_FILES['photo']['name'];
$mail = $_POST['mail'];
$tel = $_POST['tel'];
$sprint = $_POST['sprint']=="sprint";
$endurance = $_POST['endurance']=="endurance";
$autre = $_POST['autre']=="autre";
$inscription_moment = date("Y-m-d H:i:s");

$sth=$conn->exec("CREATE TABLE IF NOT EXISTS participants(
					id INTEGER PRIMARY KEY,
					pseudo TEXT,
					nom TEXT,
					prenom TEXT,
					photo TEXT,
					mail TEXT,
					tel TEXT,
					sprint TEXT,
					endurance TEXT,
					autre TEXT,
					inscription_moment TEXT);");

$sth=$conn->exec('INSERT INTO
					participants(pseudo, nom, prenom, photo,  mail, tel, sprint, endurance, autre, inscription_moment) 
					VALUES("'.$pseudo.'","'.$nom.'","'.$prenom.'","'.$photo.'","'.$mail.'","'.$tel.'","'.$sprint.'","'.$endurance.'","'.$autre.'","'.$inscription_moment.'");');

?>
