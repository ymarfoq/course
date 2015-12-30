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

$conn->exec("CREATE TABLE IF NOT EXISTS benevoles(
                                        id INTEGER PRIMARY KEY,
                                        prenom TEXT,
                                        nom TEXT,
                                        mail TEXT,
                                        motivation TEXT);");
                                        


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
				<label>Sujet</label><input type='text' name='discussionName'><br>
				<input value='ajouter une discussion'type='submit'>
		</form>";
	}
	else {
		$messages = $conn->query('SELECT * FROM discussions WHERE discussionId="'.substr($_POST["discussionId"],10).'";')->fetchAll();
		foreach ($messages as $message) {
			if ($message['message'] != "") {
				echo "<div>
						<p><h3>" . $message['auteur'] . "</h3>, le <span>" . $message['date'] . ", à " . $message['time'] . "</span> : </p>
						<p>" . $message['message'] . "</p>
						<hr>
					</div>";
			}
		};
		
		
	};
}
elseif($action=="changeOrganisation"){
	if($_POST["organisationId"]=="benevole"){
		echo "<p>Bonjour,
				<br><br>
				tu souhaites être bénévole pour nous aider à organiser la course de vélo sur neige?
				<br>
				<br>
				tu es au bon endroit ;-)
			</p>
			<br><br>
			<form method=POST action='data.php'>
				<input type='hidden' name='action' value='ajoutBenevole'>
				<label>Prénom : </label><input type='text' name='prenom'>	
				<label>Nom : </label><input type='text' name='nom'>
				<br><br>
				<label>Mail : </label><input type='mail' name='mail' required>
				<br><br>
				<textarea name='motivation' cols=50>Laisse-nous un petit mot sur tes motivations pour nous aider :)</textarea>
				<br><br>
				<input value='devenir bénévole' type='submit'>
		</form>";
	}
	elseif($_POST["organisationId"]=="parcours"){
		//echo '<iframe src=\'https://www.google.com/maps/embed?z=10&pb=!1m44!1m12!1m3!1d1726.7477048256383!2d-73.6320638675518!3d45.53347948644472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m29!3e1!4m3!3m2!1d45.5329384!2d-73.63089169999999!4m3!3m2!1d45.5332945!2d-73.6315323!4m3!3m2!1d45.533725499999996!2d-73.6321443!4m3!3m2!1d45.5341575!2d-73.6307394!4m3!3m2!1d45.533834299999995!2d-73.6294856!4m3!3m2!1d45.533060899999995!2d-73.6301455!4m3!3m2!1d45.532936899999996!2d-73.6308954!5e1!3m2!1sfr!2sca!4v1451446952849\' width="95%" height="90%" frameborder="0" style="border:0" allowfullscreen></iframe>';
		echo '
    <script type="text/javascript">

var map,organisationSubBlock;
organisationSubBlock = document.getElementById("organisationSubBlock");
function initMap() {
  organisationSubBlock.style.width ="95%";
  organisationSubBlock.style.height ="80%";
  map = new google.maps.Map(organisationSubBlock, {
    center: {lat: 45.5335239, lng: -73.6304388},
    zoom: 18,
    mapTypeId: google.maps.MapTypeId.SATELLITE
  });
}

    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyw86lHFR5aq_tTnf2-VtBLqSjLl1vHG0&callback=initMap">
    </script>
    
    ';
	};
}
elseif($action=="ajoutBenevole"){
	$sth=$conn->exec('INSERT INTO benevoles(prenom, nom, mail,motivation) VALUES("'.$_POST['prenom'].'","'.$_POST['nom'].'","'.$_POST['mail'].'","'.$_POST['motivation'].'");');
	$mail="Bonjour, 
	Une nouvelle demande de bénévolat vient d'arriver pour la course de vélo.
	
	".$_POST['prenom']." ".$_POST['nom']." voudrait être bénévol(e) pour les raisons suivantes : 
	
	".$_POST['motivation'].".
	
	Vous pouvez le(a) joindre à l'adresse suivante : ".$_POST['mail'].".";
	if(mail("marfoq.yohan@gmail.com" , "Nouveau bébévole ;-)", $mail, 'From: webmaster@coursevelosurneige.com')){echo "envoie ok";};
	
	header('Location:./');
};



?>
