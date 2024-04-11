<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(!isset($_SESSION['usager'])){
        header('Location: connexion.php');
        exit();
    }
    $usager = unserialize($_SESSION['usager']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Profil</title>
    <link rel="stylesheet" href="css/profil.css">
</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Site de Rencontre</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="js/inscription.js"></script>
</head>
<body>
    <header>
        <a href="accueilUtilisateur.php">
            <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
        </a>
        <h1>StarLove</h1>
    </header>

    <main>
        <form action="verificationProfil.php" method="post">
            <div class="infoClassique">
                <img src="" alt="Photo de profil :" id="photoProfil">
                <?php
                    echo "<p>Nom : <input type=\"text\" name=\"nom\" value=\"".$usager->getNom()."\" required></input></p>";
                    echo "<p>Prénom : <input type=\"text\" name=\"prenom\" value=\"".$usager->getPrenom()."\" required></input></p>";
                    echo "<p>Date de naissance : <input type=\"date\" name=\"ddn\" id=\"ddn\" value=\"".$usager->getDdn()."\" min=\"1900-01-01\" required pattern=\"\d{4}-\d{2}-\d{2}\"></input></p>";
                ?>
            </div>
            <div class="infoComplémentaire">
                <?php
                    echo "<p>Bio : <input type=\"text\" name=\"bio\" value=\"".$usager->getDescription()."\"></input></p>";
                ?>
            </div>
            <input type="submit" value="Modifier mon profil">
        </form>

    </main>

    <footer>
        <div class="footer-nav">
                <ul>
                    <li><a href="#">Mentions légales</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
        </div>
        <div class="copyright">
            <p>&copy; 2024 Site de Rencontre - Tous droits réservés</p>
        </div>
    </footer>
</body>
</html>
