<?php

# pour les versions antérieures à PHP8 (pour lesquelles la fonction n'existe pas nativement), 
# créé une fonction permettant de savoir si une chaine de cacactères est comprise dans une autre
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }
}


function lire_commande() {
    $table = "";
    # on lit le fichier sous forme d'une liste de chaque ligne (ne comprenant pas les "\n")
    $fichier = file("commande.csv", FILE_IGNORE_NEW_LINES);
    # on vérifie que le fichier a bien été ouvert
    if ($fichier) {
        # récupère la dernière commande passée dans le fichier des commandes
        $line = $fichier[count($fichier)-1];
        # sépare la ligne en une liste comprenant chaque information sur la commande et l'utilisateur ayant commandé
        $fields = explode(";", $line);

        # calcul du prix
        $prix=0;
        # en fonction du modèle
        if ($fields[4] == "mouche" or $fields[4] == "moustique"){
            $prix += 1270;
        } else {
            $prix += 1495;
        }

        # en fonction de la résolution
        if ($fields[5] == "1280p x 720p"){
            $prix *= 1;
        } elseif ($fields[5] == "1920p x 1080p"){
            $prix *= 1.4;
        } else {
            $prix *= 1.9;
        }

        # en fonction des options
        if (str_contains($fields[6], "Connexion bluetooth")){
            $prix += 192;
        }
        if (str_contains($fields[6], "Détecteur de mouvements")){
            $prix += 327;
        }
        if (str_contains($fields[6], "Bourdonnement réaliste")){
            $prix += 875;
        }   


        # remmmplissage du tableau comprenant tout le récapitulatif de la commande
        $table = "
        <tr> <td>Nom et prénom</td> <td>{$fields[0]}</td> </tr>
        <tr> <td>Contact</td> <td>{$fields[1]}, {$fields[2]}</td> </tr>
        <tr> <td>Adresse de livraison</td> <td>{$fields[3]}</td> </tr>

        <tr class='doubleBorderTop'> <td>Modèle commandé</td> <td>{$fields[4]}</td> </tr>
        <tr> <td>Résolution</td> <td>{$fields[5]}</td> </tr>
        <tr> <td>Options supplémentaires</td> <td>{$fields[6]}</td> </tr>

        <tr class='doubleBorderTop'> <td>Prix</td> <td>{$prix} €</td> </tr>

        </tr>";
    }
    return $table;
}

# modifie un message en fonction de si un commentaire a été laissé avec la commande
function commentaire_supplementaire() {
    $infos = lire_commande();
    $commentaire = $infos[7]; # récupère le champ du commentaire
    $message = "<p id='messageCommentaire'>A bientot !";
    if ($commentaire != ""){
        $message = "<p id='messageCommentaire'>Nous avons bien pris en compte votre commentaire et vous en remercions.<br>A bientot !";
    }
    $message .= "</p>";
    return $message;
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
        <?php echo lire_commande(); ?>
	</table>

    <?php echo commentaire_supplementaire(); ?>


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