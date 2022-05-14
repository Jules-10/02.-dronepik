<!-- 
Auteur : Jules Tennenbaum
Date : 05/2022
Projet : page Dronépik NSI première - HTML/CSS/JS/PHP 
 -->

 <style>
    <?php include 'style.css' ?>
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> Je ne comprend pas pourquoi simplement avec ces balises le site bug, c'est pourquoi je l'ai inclus dans des balises php-->
    <title>Commande</title>
	<link rel="icon" type="image/png" href="images/favicon.jpg" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <header>
        <img  src="./images/pub.png" alt="bannière Dronépik">
		<h1>Formulaire de commande</h1>
	</header>


	<div class="loader-wrapper">
		<span class="loader"><span class="loader-inner"></span></span>
	</div>
	
	<p id="messageBienvenue">Bonjour !</p>

    <form action="enregistre_cmd.php" method="GET">

		<div class="plusieursChamps">
			<label>Nom : </label>
			<input type="text" value="" onmouseout="getNoms()" id="saisiePrenom" class="zoneText" placeholder="Prénom" name="prenom" required>
			<input type="text" value="" onmouseout="getNoms()" id="saisieNom" class="zoneText" placeholder="Nom de famille" name="nom" required>
		</div>

		<div class="plusieursChamps">
			<label>Contact : </label>
			<input type="email" value="" id="saisieEmail" class="zoneText" placeholder="john.doe@gmail.com" name="email" required>
			<input type="tel" value="" id="saisieNumTel" class="zoneText small" placeholder="02 99 28 81 00" name="telephone">
		</div>

		<div class="plusieursChamps">
			<label>Adresse : </label>
			<input type="text" value="" id="saisieAdresse" class="zoneText" placeholder="144 Bd de Vitré" name="adresse_rue" required>
			<input type="number" value="" id="saisieCodePostal" class="zoneText small" placeholder="35700" name="adresse_codepostal" required>
			<input type="text" value="" id="saisieVille" class="zoneText small" placeholder="RENNES" name="adresse_ville" required>

		</div>

		<h2>Caractéristiques du Dronépik</h2>

		<div class="labelEtChamp">
			<label for="modeles">Modèle : </label>
			<select name="modeles" id="modeles" required>
				<option value="..." id="rien">....</option >
				<option value="mouche" id="mouche"> mouche </option> 
				<option value="moustique" id="moustique"> moustique </option>
				<option value="guepe" id="guepe"> guêpe </option>
				<option value="bourdon" id="bourdon"> bourdon </option>
			</select>
		</div>
		
		<div class="labelEtChamp">
			<label for="resolution">Resolutions : </label>
			<div id="resolutions" class="rowDisplay">
				<div class="labelEtChamp"><input type="radio" name="resolution" value="1280p x 720p" id="resolution1" required> <label for="resolution1">1280p x 720p</label></div>
				<div class="labelEtChamp"><input type="radio" name="resolution" value="1920p x 1080p" id="resolution2" > <label for="resolution2">1920p x 1080p</label></div>
				<div class="labelEtChamp"><input type="radio" name="resolution" value="4096 x 2160p" id="resolution3" > <label for="resolution3">4096 x 2160p</label></div> 
			</div>
		</div>


		<div class="labelEtChamp">
			<label for="option1">Options : </label>
			<div id="options" class="rowDisplay"> 
				<div class="labelEtChamp"><input type="checkbox" name="option1" value="Connexion bluetooth" id="option1" > <label for="option1">Connexion bluetooth</label></div>
				<div class="labelEtChamp"><input type="checkbox" name="option2" value="Détecteur de mouvements" id="option2" > <label for="option2">Détecteur de mouvements</label></div>
				<div class="labelEtChamp"><input type="checkbox" name="option3" value="Bourdonnement réaliste" id="option3" > <label for="option3">Bourdonnement réaliste</label></div>
			</div>
		</div>

		<textarea name="commentaire" id="commentaire" rows="10" placeholder="Nous faire passer un message"></textarea>

		
		
		<!-- le bouton d'enregistrement du formulaire -->
		<div class="buttons-container">
			<input type="submit" value="Valider la commande" id="envoiForm" class="action full">
			<input type="button" value="afficher toutes les commandes" onclick="redirect_display_cmd()" id="cmd_display" class="action">
		</div>
    </form>
	
	
	<footer>
		<p>© Jules Tennenbaum - NSI Joliot Curie - 11/05/2022</p>
		<a href="http://jigsaw.w3.org/css-validator/check/referer">
			<img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="CSS Valide !" />
		</a>
	</footer>



<script>

	// page loading animation
	$(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });

	// récupère les noms et modifie l'affichage en conséquent
	function getNoms(){
		var prenom = document.getElementById("saisiePrenom").value;
		var nom = document.getElementById("saisieNom").value;
		var textAffiche = document.getElementById("messageBienvenue");
		textAffiche.innerHTML = "Bonjour " + prenom + " " + nom + " !";
	}
	
	function redirect_display_cmd(){
		document.location.href="liste_commandes.php";
	}
</script>


</body>
</html>