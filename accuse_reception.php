<!-- 
Auteur : Jules Tennenbaum
Date : 05/2022
Projet : page Dronépik NSI première - HTML/CSS/JS/PHP 
 -->


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
    $message = "<p id='messageCommentaire' style='opacity: 0.8; margin-top: 10px;'>A très vite !";
    if ($commentaire != ""){
        $message = "<p id='messageCommentaire' style='opacity: 0.8; margin-top: 10px;'>Nous avons bien pris en compte votre commentaire et vous en remercions.<br>A très vite !";
    }
    $message .= "</p>";
    return $message;
}

?>


<!-- Pour que le CSS s'applique au PHP -->
<style>
    <?php include 'style.css' ?>
</style>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>Accusé commande Dronépik</title>
    <link rel="icon" type="image/png" href="images/favicon.jpg" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <header>
        <p id="pub"><img  src="./images/pub.png" alt="bannière Dronépik"></p>    
		<h1>Accusé de réception</h1>
	</header>

    <div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>
	
    <h3> Merci pour votre commande ! Nous en accusons réception.</h3>
	<h4>Voici un récapitulatif de toutes vos coordonnées ainsi que de la fiche technique du Dronépik :</h4>

	<table>
        <?php echo lire_commande(); ?>
	</table>

    <?php echo commentaire_supplementaire(); ?>


    <input type="button" value="Faire une nouvelle commande" onclick="nouvelleCommande()" id="nouvelle_commande" class="action">

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

	// redirection vers la page principale
	function nouvelleCommande(){
		document.location.href="dronepik.html";
	}
</script>

</body>
</html>