<?php
    
    # on récupère les données
    $nom = $_GET['nom'] . " " . $_GET['prenom'];
	$email = $_GET['email'];
	$phone_number = $_GET['telephone'];
	$adresse = $_GET['adresse_rue'] . " " . $_GET['adresse_codepostal'] . " " . $_GET['adresse_ville'];
	$modele = $_GET['modeles'];
    $resolution = $_GET['resolution']; 

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
	
	if ($nom != "" and $email != "" and $adresse != "" and $modele != "" and $resolution != "") {
        # on ouvre le fichier commandes.csv en mode ajout
        $fichier = fopen("commande.csv", "a");
        
        # on écrit le nom, prénom et e-mail dans le fichier
        $enregistrement = "$nom;$email;$phone_number;$adresse;$modele;$resolution;$options\n";
        fputs($fichier, $enregistrement);
        
        # on ferme le fichier
        fclose($fichier);
    }
    # on rappelle la page d'accueil
    header("Location: accuse.html");

?>