<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(isset($_SESSION["admin"])) {
        $admin = unserialize($_SESSION["admin"]);
        if($admin->getProfil() != "admin") {
            header('Location: connexion.php');
            exit();
        }
    } else if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        switch($usager->getProfil()) {
            case "utilisateur":
                header('Location: accueilUtilisateur.php');
                break;
            case "abonne":
                header('Location: accueilAbonne.php');
                break;
            default:
                header('Location: connexion.php');
        }
        exit();
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
          <h1 id="accueil">Accueil administrateur</h1>
        </div>
    </body>
</html>
