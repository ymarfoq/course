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
		<table width=100% height=100% cellspacing=0>
			<tr width=100% height=50%>
				<td id="inscriptions_block" class="principal_block" width=50%>
					<form enctype='multipart/form-data'>
						<h1>Inscription</h1>
						<label for="nom">Nom : </label><input id="nom" type="text" name="nom" size=10/>
						<label for="prenom">Prénom : </label><input id="prenom" type="text" name="prenom" size=10/>
						<label for="pseudo">Pseudo : </label><input id="pseudo" type="text" name="pseudo" size=10/><br>
						<br>
						<label for="mail">Mail : </label><input id="mail" type="mail" name="mail"  size=20/>
						<label for="tel">Tel : </label><input id="tel" type="text" name="tel"  size=6/><br>
						<br>
						<label for='photo'>Photo : </label><input type='file' name='photo' id="photo"><br>
						<br>
						<label for='sprint'> Sprint</label><input type="checkbox" name="sprint" id="sprint" value="sprint">
						<label for='endurance'> Endurance</label><input type="checkbox" name="endurance" id="endurance" value="endurance">
						<label for='autre'> Autre</label><input type="checkbox" name="autre" id="autre" value="autre">
						<br><br>
						<button id="submit" type="submit">Inscription</button>
					</form>
				</td>
				<td id="inscrits_block" class="principal_block" width=50%>
					<h1>Liste des inscrits</h1>
					<table cellspacing=15>
						<tr>
							<th align=center>pseudo</th>
							<th align=center>Vélo</td>
							<th align=center>Sprint</th>
							<th align=center>Endurance</th>
							<th align=center>Autre</th>
						</tr>
						<tr>
							<td align=center>MysterYo</th>
							<td align=center><img src="images/participant1.png" width=50 height=50></td>
							<td align=center>oui</td>
							<td align=center>oui</td>
							<td align=center>???</td>
						</tr>
					
					</table>
					<ul id="liste_participants">
					</ul>
				
				</td>
			</tr>
			<tr width=100% height=50%>
				<td id="album_block" class="principal_block" width=50%>
				
				
				</td>
				<td id="media_block"class="principal_block" width=50%>
				
				
				</td>
			</tr>
		</table>
	</body>
	<script type="text/javascript" src="script.js"> </script>
</html>

