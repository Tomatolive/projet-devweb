<?php
    session_start();
    require_once 'Admin.php';
    if(isset($_SESSION["admin"])) {
        $admin = unserialize($_SESSION["admin"]);
        if($admin->getProfil() != "admin") {
            if($admin->getProfil() == "utilisateur") {
                header('Location: accueilUtilisateur.php');
            } else if($admin->getProfil() == "abonne") {
                header('Location: accueilAbonne.php');
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
          <h1 id="accueil">Accueil administrateur</h1>
        </div>
    </body>
</html>
