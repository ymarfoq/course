<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
	<head>
		<meta charset="UTF-8">
		<title>Course de vélo</title>
		<link rel="shortcut icon" href="icone.ico" type="image/x-icon">
		<link rel="StyleSheet" href="style.css" type="text/css">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	</head>

	<body>
		<div id="top_block">
			<div id="inscriptions_block" class="principal_block">
				<form enctype='multipart/form-data' action="" method="post" id="inscription_form">
					<h1>Inscription</h1>
					<table>
						<tr>
						<td><label>Pseudo : </label></td>
						<td><input id="pseudo" type="text" name="pseudo" size=10></td>
						<td colspan=2></td>
						</tr>
						<tr>
						<td><label>Nom : </label></td>
						<td><input id="nom" type="text" name="nom" size=10></td>
						<td><label>Prénom : </label></td>
						<td><input id="prenom" type="text" name="prenom" size=10></td>
						</tr>
						<tr>
						<td><label>Mail : </label></td>
						<td colspan=3><input id="mail" type="mail" name="mail" value="nom@mail.com"></td>
						</tr>
						<tr>
						<td><label>Tel : </label></td>
						<td><input id="tel" type="text" name="tel" value="(514)-000-0000" size=6></td>
						<td colspan=2></td>
						</tr>
						<tr>
						<td><label>Photo : </label></td>
						<td colspan=2><input type='file' name='photo' id="photo"></td>
						<td><img id="load_photo" src="photos/origine.png" alt="vélo" height=50></td>
						</tr>
						<tr>
						<td colspan=4><textarea name="description" id="description" cols=80% rows=3>Qui es-tu?</textarea></td>
						</tr>
						<tr>
						<td><label> Sprint</label><input type="checkbox" name="sprint" id="sprint" value="sprint" checked></td>
						<td><label> Endurance</label><input type="checkbox" name="endurance" id="endurance" value="endurance"></td>
						<td><label> Autre</label><input type="checkbox" name="autre" id="autre" value="autre"></td>
						<td></td>
						<td></td>
						</tr>
						<tr>
						<td><input type="submit" value="inscription" class="submit"/></td>
						<td colspan=3></td>
						</tr>
					
					</table>
				</form>
			</div>
			<div id="inscrits_block" class="principal_block">
				<h1>Liste des inscrits</h1>
				<table cellspacing=0 id="liste_participants" width=100%>
					<tr>
						<th align=center>pseudo</th>
						<th align=center>Vélo</th>
						<th align=center>Sprint</th>
						<th align=center>Endurance</th>
						<th align=center>Autre</th>
					</tr>
					<tr id="first_line"><td height=10 colspan=5></td></tr>
<?php
$conn = new PDO('sqlite:base.db');
					
	$participants = $conn->query('SELECT * FROM participants ORDER BY ID DESC;')->fetchAll();
	
	foreach ($participants as $participant){
		if($participant["sprint"]==1){$sprint = 'images/tick.png';}else{$sprint = 'images/cross.png';}
		if($participant["endurance"]==1){$endurance = 'images/tick.png';}else{$endurance = 'images/cross.png';}
		if($participant["autre"]==1){$autre = 'images/tick.png';}else{$autre = 'images/cross.png';}
				echo 	"<tr title='".$participant["description"]."'>
							<td align=center>".$participant["pseudo"]."</td>
							<td align=center><img src='".$participant["photo"]."' height=50></td>
							<td align=center><img src='".$sprint."' height=25></td>
							<td align=center><img src='".$endurance."' height=25></td>
							<td align=center><img src='".$autre."' height=25></td>
				</tr><tr><td colspan=5><hr></td></tr>";
			}
?>
				</table>				
			</div>
		</div>
		<div id="bottom_block">
			<div id="album_block" class="principal_block">
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</div>
			<div id="media_block" class="principal_block">
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="script.js"> </script>
</html>

