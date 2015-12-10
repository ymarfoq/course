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

$conn->exec("CREATE TABLE IF NOT EXISTS photos(
                                        id INTEGER PRIMARY KEY,
                                        adress TEXT);");

$conn->exec("CREATE TABLE IF NOT EXISTS discussions(
                                        id INTEGER PRIMARY KEY,
                                        discussionId INTEGER,
                                        discussionName TEXT,
                                        auteur TEXT,
                                        date TEXT,
                                        time TEXT,
                                        message TEXT);");


$action=$_POST['action'];

if($action=="verification"){
	$exist=$conn->query('SELECT COUNT(*) as count FROM participants WHERE pseudo="'.$_POST["pseudo"].'";')->fetch();
	echo $exist['count'];
}
elseif($action=="verification_mail"){
	$exist=$conn->query('SELECT COUNT(*) as count FROM participants WHERE mail="'.$_POST["mail"].'";')->fetch();
	echo $exist['count'];
}
elseif($action=="inscription"){
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
elseif($action=="ajouter_photos"){
	if(count($_FILES['album_photo']['name'])) {
		foreach ($_FILES['album_photo']['name'] as $position => $file) {
			$adresse = "album/".strtolower($file);
			move_uploaded_file($_FILES['album_photo']['tmp_name'][(string)$position],$adresse);
			$sth=$conn->exec('INSERT INTO photos(adress) VALUES("'.$adresse.'");');
		}
	}
	header('Location:./');
}
elseif($action=="supprimer_photo"){
	$sth=$conn->exec('DELETE FROM photos WHERE id="'.$_POST['id'].'";');
	header('Location:./');
}
elseif($action=="ajoutDiscussion"){
	$count=$conn->query('SELECT MAX(discussionId) as max from discussions;')->fetch();
	$conn->exec('INSERT INTO discussions(discussionId, discussionName) VALUES('.($count["max"]+1).',"'.$_POST["discussionName"].'");');
	header('Location:./?discussion='.($count["max"]+1));
}
elseif($action=="changeDiscussion"){
	if($_POST["discussionId"]=="ajoutDiscussion"){
		echo "<form method=POST action='data.php'>
				<input type='hidden' name='action' value='ajoutDiscussion'>
				<input type='text' name='discussionName'>
				<input type='submit'>
		</form>";
	}
	else {
		$messages = $conn->query('SELECT * FROM discussions WHERE discussionId="'.substr($_POST["discussionId"],10).'";')->fetchAll();
		foreach ($messages as $message) {
			if ($message['message'] != "") {
				echo "<div>
						<p>De <span>" . $message['auteur'] . "</span>, le <span>" . $message['date'] . ", à " . $message['time'] . "</span> : </p>
						<p>" . $message['message'] . "</p>
					</div>";
			};
		};
	};
};

?>
