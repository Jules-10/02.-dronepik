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

    # ouverture de la base de données
    function tableau_commandes(){

        // On créé le tableau en commençant par l'en-tête
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
                // on compte le nombre de commandes total
                // On créé une ligne du tableau contenant les informations de la ligne sélectionnée
                $table .= "<tr>
                    <td>$ligne[0]</td>
                    <td>$ligne[1]</td>
                    <td>$ligne[2]</td>
                    <td>$ligne[3]</td>
                    <td>$ligne[4]</td>
                    <td>$ligne[5]</td>
                    <td>$ligne[6]</td>
                    <td>$ligne[7]</td>
                    </tr>\n";
                $ligne = fgetcsv($fichier, 1000, ";"); # on lit la ligne suivante
            }
        }
        return $table;
    }

    function tableau_recap(){
        // On créé le tableau en commençant par l'en-tête
        $table_modeles = "<table class='admin recap modeles'>
        <tr>
        <td>Modèle</td>
        <td>Guêpe</td>
        <td>Mouche</td>
        <td>Bourdon</td>
        <td>Moustique</td>
        <td>Total</td>
        </tr>\n";

        $table_resolutions = "<table class='admin recap resolutions'>
        <tr>
        <td>Résolution</td>
        <td>1280p x 720p</td>
        <td>1920p x 1080p</td>
        <td>4096p x 2160p</td>
        </tr>\n";

        $table_options = "<table class='admin recap options'>
        <tr>
        <td>Options</td>
        <td>Connexion bluetooth</td>
        <td>Détecteur de mouvements</td>
        <td>Bourdonnement réaliste</td>
        <td>Total</td>
        </tr>\n";

        # on lit le fichier et on ajoute ligne par ligne
        $fichier = fopen("commande.csv", "r");
        // on initialise les variables pour compter les modeles/options/resolutions
        $modeles = [0,0,0,0];
        $resolutions = [0,0,0];
        $options = [0,0,0];
        # on vérifie que le fichier a bien été ouvert
        if ($fichier) {
            $ligne = fgetcsv($fichier, 1000, ";"); # on lit la 1ère ligne
            while ($ligne) {
                // on compte le nombre de commande de chaque modèle
                if ($ligne[4] == "guepe"){
                    $modeles[0] += 1;
                } elseif ($ligne[4] == "mouche"){
                    $modeles[1] += 1;
                } elseif ($ligne[4] == "bourdon"){
                    $modeles[2] += 1;
                } else {
                    $modeles[3] += 1;
                }
                // on compte le nombre de commande de chaque resolution
                if ($ligne[5] == "1280p x 720p"){
                    $resolutions[0] += 1;
                } elseif ($ligne[5] == "1920p x 1080p"){
                    $resolutions[1] += 1;
                } else {
                    $resolutions[2] += 1;
                }
                // on compte le nombre de commande comprenant chaque option
                if (str_contains($ligne[6], "Connexion bluetooth")){
                    $options[0] += 1;
                }
                if (str_contains($ligne[6], "Détecteur de mouvements")){
                    $options[1] += 1;
                }
                if (str_contains($ligne[6], "Bourdonnement réaliste")){
                    $options[2] += 1;
                }   


                $ligne = fgetcsv($fichier, 1000, ";"); # on lit la ligne suivante
            }

            // modification des tableaux
            $total_quantity = $modeles[0]+$modeles[1]+$modeles[2]+$modeles[3];
            $table_modeles .= "<tr>
            <td>Quantité</td>
            <td>$modeles[0]</td>
            <td>$modeles[1]</td>
            <td>$modeles[2]</td>
            <td>$modeles[3]</td>
            <td>$total_quantity</td>
            </tr>
            </table>";

            $table_resolutions .= "<tr>
            <td>Quantité</td>
            <td>$resolutions[0]</td>
            <td>$resolutions[1]</td>
            <td>$resolutions[2]</td>
            </tr>
            </table>";

            $total_quantity = $options[0]+$options[1]+$options[2];
            $table_options .= "<tr>
            <td>Quantité</td>
            <td>$options[0]</td>
            <td>$options[1]</td>
            <td>$options[2]</td>
            <td>$total_quantity</td>
            </tr>
            </table>";
        }
        return $table_modeles . $table_resolutions . $table_options;
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
    <title>Admin Dronépik - liste commandes</title>
    <link rel="icon" type="image/png" href="images/favicon.jpg" />
    <!-- jQuery nécessaire pour le loader de page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body class="admin">
    <header>
		<h1>Liste des commandes passées</h1>
	</header>

    <div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <table class="admin">
        <?php echo tableau_commandes(); ?>
	</table>

    <?php echo tableau_recap(); ?>

    <a href="dronepik.html" class="button violet">Commander un Dronépik</a>

	<footer>
		<p>© Jules Tennenbaum - NSI Joliot Curie - 05/2022</p>
	</footer>

</body>

</html>

<script>

    // page loading animation
    $(window).on("load",function(){
        $(".loader-wrapper").fadeOut("slow");
    });

</script>