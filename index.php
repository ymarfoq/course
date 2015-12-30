<?php
session_start();
$conn = new PDO('sqlite:base.db');
if(isset($_POST['connexion'])){
	if($_POST['connexion']=='trophée900'){$_SESSION['admin']=1;}
	else{$_SESSION['admin']=0;}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<meta charset="UTF-8">
		<title>Course de vélo</title>
		<link rel="shortcut icon" href="icone.ico" type="image/x-icon">
		<link rel="StyleSheet" href="style.css" type="text/css">
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/jssor.slider.mini.js"></script>
	</head>

	<body>
		<form method='post' id='admin'>
<?php
if($_SESSION['admin']){echo '<input type="hidden" name="connexion"><input type="submit" value="deconnexion">';}
else{echo '<input type="password" name="connexion" size=10><input type="submit" value=";)">';}
?>
		</form>
		
		<div id="inscriptions_block" class="principal_block">
			<div class="titre"><h1>Inscription</h1></div>
			<form enctype='multipart/form-data' action="" method="post" id="inscription_form">
				<input type='hidden' name='action' value='inscription'>
				<table cellspacing="10">
					<tr>
						<td><label>Pseudo : </label></td>
						<td><input id="pseudo" type="text" name="pseudo" size=10></td>
						<td colspan=2></td>
						</tr>
					<tr>
						<td><label>Prénom : </label></td>
						<td><input id="prenom" type="text" name="prenom" size=10></td>
						<td><label>Nom : </label></td>
						<td><input id="nom" type="text" name="nom" size=10></td>
						</tr>
					<tr>
						<td><label>Mail : </label></td>
						<td colspan=3><input id="mail" type="mail" name="mail" value="nom@mail.com" size=25></td>
						</tr>
					<tr><td colspan=4><br></td></tr>
					<!--<tr>
						<td><label>Tel : </label></td>
						<td><input id="tel" type="text" name="tel" value="(514)-000-0000" size=10></td>
						<td colspan=2></td>
						</tr>-->
					<tr>
						<td><label>Image de mon vélo : </label></td>
						<td colspan=2><input type='file' name='photo' id="photo"></td>
						<td><img id="load_photo" src="photos/origine.png" alt="vélo" height=50></td>
					</tr>
					<tr>
						<td colspan=4><textarea name="description" id="description" cols=80% rows=3>Quelques mots sur moi...</textarea></td>
					</tr>
					<tr><td colspan=4><br></td></tr>
					<tr><td colspan=4><h3>A quelle course voulez-vous participer?</h3></td></tr>
					<tr>
						<td><label> Sprint</label><input type="checkbox" name="sprint" id="sprint" value="sprint" checked></td>
						<td><label> Endurance</label><input type="checkbox" name="endurance" id="endurance" value="endurance"></td>
						<td><label> Autre</label><input type="checkbox" name="autre" id="autre" value="autre"></td>
						<td></td>
					</tr>
					<tr>
						<td colspan="4"><input type="submit" value="inscription" class="submit"/></td>
					</tr>
				</table>
			</form>
		</div>
		
		<div id="inscrits_block" class="principal_block">
			<div class="titre"><h1>Liste des inscrits</h1></div>
			<table cellspacing=0 id="liste_participants">
				<tbody>
					<tr>
						<th align=left>pseudo</th>
						<th>Vélo</th>
						<th width="80">Sprint</th>
						<th width="80">Endurance</th>
						<th width="80">Autre</th>
					</tr>
					<tr id="first_line"><td height=10 colspan=5></td></tr>

<?php
	$participants = $conn->query('SELECT * FROM participants ORDER BY ID DESC;')->fetchAll();
	foreach ($participants as $participant){
		if($participant["sprint"]==1){$sprint = 'images/tick.png';}else{$sprint = 'images/cross.png';}
		if($participant["endurance"]==1){$endurance = 'images/tick.png';}else{$endurance = 'images/cross.png';}
		if($participant["autre"]==1){$autre = 'images/tick.png';}else{$autre = 'images/cross.png';}
				echo 	"<tr id='".$participant["id"]."' title='".$participant["description"]."'>
							<td align=left>".$participant["pseudo"]."</td>
							<td><img src='".$participant["photo"]."' height=50></td>
							<td><img src='".$sprint."' height=15></td>
							<td><img src='".$endurance."' height=15></td>
							<td><img src='".$autre."' height=15></td>";
				if($_SESSION['admin']){
					echo "<td align=center><form action='data.php' method='post'>
							<input type='hidden' name='action' value='supprimer'>
							<input type='hidden' name='mail' value='".$participant["mail"]."'>
							<input type='submit' value='x'>
						</form></td>";
					}
					echo "</tr><tr><td colspan=5><hr></td></tr>";
			}
?>
				</tbody>
			</table>
		</div>
		
		<div id="album_block" class="principal_block">
			<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden; visibility: hidden;">
				<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden;">
					<?php
						$photos = $conn->query('SELECT * FROM photos ORDER BY ID DESC;')->fetchAll();
						foreach ($photos as $photo){
							echo 	"<div data-p='112.50' style='display: none;'>";
							if($_SESSION['admin']){
								echo "<form data-u='image' action='data.php' method='post'>
										<input type='hidden' name='action' value='supprimer_photo' >
										<input type='hidden' name='id' value='".$photo['id']."' >
										<input style='position:absolute; right:0;'type='submit' value='x'>
										<img src='".$photo['adress']."'/>
									</form>";
							}
							else{
								echo "<img data-u='image' src='".$photo['adress']."'/>";
							}
							echo "</div>";
						}
						if($_SESSION['admin']){
							echo "<div data-p='112.50' style='display: none;'>
									<form style='margin:20px;' action='data.php' method='post' enctype='multipart/form-data'>
										<input type='hidden' name='action' value='ajouter_photos' >
										<input type='file' name='album_photo[]' multiple>
										<input type='submit' value='ajouter'>
									</form>
								</div>";
						}
					?>
				</div>
				<!-- Bullet Navigator -->
				<div data-u="navigator" class="jssorb05" style="bottom:16px;right:6px;" data-autocenter="1">
					<!-- bullet navigator item prototype -->
					<div data-u="prototype" style="width:16px;height:16px;"></div>
				</div>
				<!-- Arrow Navigator -->
				<span data-u="arrowleft" class="jssora12l" style="top:123px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
				<span data-u="arrowright" class="jssora12r" style="top:123px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
			</div>
		</div>
		
		<div id="organisation_block" class="principal_block">
			<div class="titre"><h1>Organisation</h1></div>
			<table id="tableOrganisation" cellspacing="0">
				<tr>
					<th class="titreOrganisation" id='benevole'>Bénévoles</th>
					<th class="titreOrganisation" id='parcours'>Parcours</th>
					<th class="titreOrganisation" id='partenaire'>Partenaire</th>
				</tr>
			</table>
			<article id="organisationSubBlock">
						<!--<iframe src="https://www.google.com/maps/embed?pb=!1m44!1m12!1m3!1d1726.7477048256383!2d-73.6320638675518!3d45.53347948644472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m29!3e1!4m3!3m2!1d45.5329384!2d-73.63089169999999!4m3!3m2!1d45.5332945!2d-73.6315323!4m3!3m2!1d45.533725499999996!2d-73.6321443!4m3!3m2!1d45.5341575!2d-73.6307394!4m3!3m2!1d45.533834299999995!2d-73.6294856!4m3!3m2!1d45.533060899999995!2d-73.6301455!4m3!3m2!1d45.532936899999996!2d-73.6308954!5e1!3m2!1sfr!2sca!4v1451446952849" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->

			</article>
		</div>
	
	</body>
	<script type="text/javascript" src="js/script.js"> </script>
</html>

