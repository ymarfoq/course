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
					<label>Pseudo : </label><input id="pseudo" type="text" name="pseudo" value="pseudo" size=10><br>

					
					<label>Nom : </label><input id="nom" type="text" name="nom" value="nom"size=10>
					<label>Prénom : </label><input id="prenom" type="text" name="prenom" value="prenom" size=10><br>
					<br>
					
					<label>Mail : </label><input id="mail" type="mail" name="mail" value="mail" size=20>
					<label>Tel : </label><input id="tel" type="text" name="tel" value="tel" size=6><br>
					<br>
					
					<label>Photo : </label><input type='file' name='photo' id="photo"><br>
					<br>
					
					<label> Sprint</label><input type="checkbox" name="sprint" id="sprint" value="sprint" checked>
					<label> Endurance</label><input type="checkbox" name="endurance" id="endurance" value="endurance">
					<label> Autre</label><input type="checkbox" name="autre" id="autre" value="autre">
					<br><br>
					
					<input type="submit" value="inscription" class="submit"/>
				</form>
			</div>
			<div id="inscrits_block" class="principal_block">
				<h1>Liste des inscrits</h1>
				<table cellspacing=15 id="liste_participants" width=100%>
					<tr>
						<th align=center>pseudo</th>
						<th align=center>Vélo</th>
						<th align=center>Sprint</th>
						<th align=center>Endurance</th>
						<th align=center>Autre</th>
					</tr>
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

