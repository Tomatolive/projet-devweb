<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        if($usager->getProfil() != "utilisateur") {
            if($usager->getProfil() == "abonne") {
                header('Location: accueilAbonne.php');
                exit();
            } else {
                header('Location: connexion.php');
                exit();
            }
        }
    } else if(isset($_SESSION["admin"])) {
        $admin = unserialize($_SESSION["admin"]);
        if($admin->getProfil() == "admin") {
            header('Location: accueilAdmin.php');
            exit();
        } else {
            header('Location: connexion.php');
            exit();
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
