<?php

function lire_commande() {
    $table = "";
    # on lit le fichier et on ajoute ligne par ligne
    $fichier = file("commande.csv", FILE_IGNORE_NEW_LINES);
    # on vérifie que le fichier a bien été ouvert
    if ($fichier) {
        # tant que on arrive à lire une ligne
        $line = $fichier[count($fichier)-2];
        $fields = explode(";", $line);
        $prix=10;
        $table = "
        <tr> <td>Nom et prénom</td> <td>{$fields[0]}</td> </tr>
        <tr> <td>Contact</td> <td>{$fields[1]}, {$fields[2]}</td> </tr>
        <tr> <td>Adresse de livraison</td> <td>{$fields[3]}</td> </tr>

        <tr class='doubleBorderTop'> <td>Modèle commandé</td> <td>{$fields[4]}</td> </tr>
        <tr> <td>Résolution</td> <td>{$fields[5]}</td> </tr>
        <tr> <td>Options supplémentaires</td> <td>{$fields[6]}</td> </tr>

        <tr class='doubleBorderTop'> <td>Prix</td> <td>{$prix}</td> </tr>

        </tr>";
    }
    return $table;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>Commande</title>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>
<body>
    <header>
        <p id="pub"><img  src="./images/pub.png" alt="bannière Dronépik"></p>    
		<h1>Accusé de réception</h1>
	</header>
	
    <h3> Merci pour votre commande ! Nous en accusons réception.</h3>
	<h4>Voici un récapitulatif de toutes vos coordonnées ainsi que de la fiche technique du Dronépik :</h4>
	<table id="infos">
        <!-- <tr> 
			<td>Nom et prénom</td>
			<td id="noms"></td>
		</tr>
		<tr>
			<td>Contact</td>
			<td id="contact"></td>
		</tr>
		<tr>
			<td>Adresse de livraison</td>
			<td id="adresse"></td>
		</tr>
		<tr class="doubleBorderTop">
			<td>Modèle commandé</td>
			<td id="modele"></td>
		</tr>
		<tr>
			<td>Résolution</td>
			<td id="resolution"></td>
		</tr>
		<tr>
			<td>Options supplémentaires</td>
			<td id="options"></td>
		</tr>
		<tr class="doubleBorderTop">
			<td>Prix</td>
			<td id="prix"></td>
		</tr> -->

        <?php echo lire_commande(); ?>

	</table>

	<p id="msgCommentaire">Nous avons bien noté votre commentaire, et en tiendrons compte ! ;)</p>

    <input type="button" value="Faire une nouvelle commande" onmouseover="overButton('nouvelle_commande')" onmouseout="notOverButton('nouvelle_commande')" onclick="nouvelleCommande()" id="nouvelle_commande" class="action">

	<footer>
		<p>© Jules Tennenbaum - NSI Joliot Curie - 19/03/2022</p>
		<a href="http://jigsaw.w3.org/css-validator/check/referer">
			<img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="CSS Valide !" />
		</a>
	</footer>




<script>

	// redirection vers la page principale
	function nouvelleCommande(){
		document.location.href="dronepik.html";
	}

	// fonctions quand on passe la souris sur un bouton, et quand on en sort
	function overButton(elmtID){
		button = document.getElementById(elmtID);
		button.style.filter = "brightness(1.1)";
		button.style.border = "solid 2px #6b616f"
		button.style.padding = "8px 28px";
	}
	function notOverButton(elmtID){
		button = document.getElementById(elmtID);
		button.style.filter = "brightness(1)";
		button.style.border = "none";
		button.style.padding = "10px 30px";
	}
</script>

</body>
</html>