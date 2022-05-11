<!-- 
Auteur : Jules Tennenbaum
Date : 05/2022
Projet : page Dronépik NSI première - HTML/CSS/JS/PHP 
 -->

<?php

    # ouverture de la base de données
    function tableau_commandes(){

        $table = "<tr>
        <td>Nom</td>
        <td>Email</td>
        <td>Téléphone</td>
        <td>Adresse de livraison</td>
        <td>Modèle</td>
        <td>Résolution</td>
        <td>Options</td>
        <td>Commentaire</td>
        </tr>\n";

        # on lit le fichier et on ajoute ligne par ligne
        $fichier = fopen("commande.csv", "r");
        # on vérifie que le fichier a bien été ouvert
        if ($fichier) {
            # tant que on arrive à lire une ligne
            $ligne = fgetcsv($fichier, 1000, ";"); # on lit la 1ère ligne
            while ($ligne) {
                $table .= "<tr>
                    <td>$ligne[0]</td>
                    <td>$ligne[1]</td>
                    <td>$ligne[2]</td>
                    <td>$ligne[3]</td>
                    <td>$ligne[4]</td>
                    <td>$ligne[5]</td>
                    <td>$ligne[6]</td>
                    <td>$ligne[7]</td>
                    <td>$ligne[8]</td>
                    </tr>\n";
                $ligne = fgetcsv($fichier, 1000, ";"); # on lit la ligne suivante
            }
        }
        return $table;
    }
?>

<html lang="fr">
<head>
    <meta charset='utf-8'>
    <title>Admin Dronépik - liste commandes</title>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <link rel="icon" type="image/png" href="images/favicon.jpg" />
</head>


<body>
    <header>
        <p id="pub"><img  src="./images/pub.png" alt="bannière Dronépik"></p>    
		<h1>Liste des commandes passées</h1>
	</header>

    <table>
        <?php echo tableau_commandes(); ?>
	</table>

    <input type="button" value="Commander un Dronépik" onmouseover="overButton('nouvelle_commande')" onmouseout="notOverButton('nouvelle_commande')" onclick="nouvelleCommande()" id="nouvelle_commande" class="action">

	<footer>
		<p>© Jules Tennenbaum - NSI Joliot Curie - 11/05/2022</p>
		<a href="http://jigsaw.w3.org/css-validator/check/referer">
			<img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="CSS Valide !" />
		</a>
	</footer>

</body>

</html>

<script>

	// redirection vers la page principale
	function nouvelleCommande(){
		document.location.href="dronepik.html";
	}
</script>