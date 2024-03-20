<?php
    session_start();
    require_once 'Usager.php';
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        if($usager->getProfil() != "abonne") {
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
          <h1 id="accueil">Accueil abonne</h1>
        </div>
    </body>
</html>
