<?php
    session_start();
    $login=$_POST["login"];
    $mdp=$_POST["mdp"];

    if (($handle = fopen("temp.csv", "r"))) {
        while (($data = fgetcsv($handle, 1000, ";"))) {
            if($data[0] == $login && $data[1] == $mdp) { 
                $_SESSION["profil"] = $data[2];
                $_SESSION["nom"] = $data[3];
                $_SESSION["prenom"] = $data[4];
                if($_SESSION["profil"] == "utilisateur") {
                    header('Location: accueilUtilisateur.php');
                    exit();
                }
                else if($_SESSION["profil"] == "abonne") {
                    header('Location: accueilAbonne.php');
                    exit();
                }
                else if($_SESSION["profil"] == "admin") {
                    header('Location: accueilAdmin.php');
                    exit();
                }
            }
        }
        fclose($handle);
    }

    header('Location: connexion.php');

?>
