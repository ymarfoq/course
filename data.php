<?php

$connStr = 'sqlite:base.db';
$conn = new PDO($connStr);

$conn->exec("CREATE TABLE IF NOT EXISTS participants(
					id INTEGER PRIMARY KEY,
					pseudo TEXT,
					nom TEXT,
					prenom TEXT,
					photo TEXT,
					mail TEXT,
					tel TEXT,
					description TEXT,
					sprint BOOLEAN DEFAULT 0,
					endurance BOOLEAN DEFAULT 0,
					autre BOOLEAN DEFAULT 0,
					inscription_moment TEXT);");
$action=$_POST['action'];

if($action=="inscription"){
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$pseudo = $_POST['pseudo'];
	$mail = $_POST['mail'];
	$tel = $_POST['tel'];
	$description = $_POST['description'];
	$sprint = $_POST['sprint']=="sprint";
	$endurance = $_POST['endurance']=="endurance";
	$autre = $_POST['autre']=="autre";
	$inscription_moment = date("Y-m-d H:i:s");
	if($_FILES['photo']['size']>50){
		$photo = "photos/".time()."".strtolower(strrchr($_FILES['photo']['name'], '.'));
		move_uploaded_file($_FILES['photo']['tmp_name'],$photo);
	}
	else{$photo="photos/origine.png";}

	$sth=$conn->exec('INSERT INTO
						participants(pseudo, nom, prenom, photo,  mail, tel, description,  sprint, endurance, autre, inscription_moment) 
						VALUES("'.$pseudo.'","'.$nom.'","'.$prenom.'","'.$photo.'","'.$mail.'","'.$tel.'","'.$description.'","'.$sprint.'","'.$endurance.'","'.$autre.'","'.$inscription_moment.'");');
}
elseif($action=="supprimer"){
	$mail=$_POST['mail'];
	$sth=$conn->exec('DELETE FROM participants WHERE mail="'.$mail.'";');
	header('Location:./');
}

?>
