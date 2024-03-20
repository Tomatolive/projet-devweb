<?php
    session_start();
    require_once 'Usager.php';
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        if($usager->getProfil() != "utilisateur") {
            if($usager->getProfil() == "abonne") {
                header('Location: accueilAbonne.php');
            } else if($usager->getProfil() == "administrateur") {
                header('Location: accueilAdmin.php');
            } else {
                header('Location: connexion.php');
                exit();
            }
        }
    } else {
        header('Location: connexion.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>
    </head>
    <body>
        <div class="titre">
            <h1 id="accueil">Accueil utilisateur</h1>
        </div>
    </body>
</html>
