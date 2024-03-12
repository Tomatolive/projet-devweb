<?php
    session_start();
    if ($_SESSION["profil"]!="utilisateur"){
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
        <?php echo "Bienvenue dans la session utilisateur";?>
    </body>
</html>
