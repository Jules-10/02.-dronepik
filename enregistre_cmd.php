<!-- 
Auteur : Jules Tennenbaum
Date : 05/2022
Projet : page Dronépik NSI première - HTML/CSS/JS/PHP 
 -->


<?php
    
    # on récupère les données
    $nom = $_GET['nom'] . " " . $_GET['prenom'];
	$email = $_GET['email'];
	$phone_number = $_GET['telephone'];
	$adresse = $_GET['rue'] . " " . $_GET['code-postal'] . " " . $_GET['ville'];
	$modele = $_GET['modele'];
    $resolution = $_GET['resolution'];
    $commentaire = $_GET['message']; 

    # on récupère les options en plaçant une virgule entre chaque
    $options = "";
    for ($i=1; $i<=3; $i++) {
        $option_i = $_GET["option{$i}"];
        if ($option_i != ""){
            if ($options != ""){
                $options .= ", ";
            }
            $options .= "{$option_i}";
        }
    }
	
    // ces informations sont nécessaire pour mener à bien une commande. Les autres sont considérées facultatives
	if ($nom != "" and $email != "" and $adresse != "" and $modele != "" and $resolution != "") {
        # on ouvre le fichier commandes.csv en mode ajout
        $fichier = fopen("commande.csv", "a");
        
        # on écrit le nom, prénom et e-mail dans le fichier
        $enregistrement = "$nom;$email;$phone_number;$adresse;$modele;$resolution;$options;$commentaire\n";
        fputs($fichier, $enregistrement);
        
        # on ferme le fichier
        fclose($fichier);
    }
    # on rappelle la page d'accueil
    header("Location: accuse_reception.php");

?>