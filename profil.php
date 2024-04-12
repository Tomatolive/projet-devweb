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
</head>
<body>
<header>
            <a href="accueilUtilisateur.php">
                <img src="../css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
            <div id="onglets">
        <ul>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="recherche.php">Recherche</a></li>
            <li><a href="messagerie/messagerie.php">Messages</a></li>
            <li><a href="vuProfil.php">Qui a vu mon profil</a></li>
            <li><a href="connexion.php">Déconnexion</a></li>
        </ul>
    </div>
        </header>

    <main>
        <div class="infoClassique">
            <?php
                echo "<img src='".$usager->getImage()."' alt='Photo de profil' id='photoProfil'>";
                echo "<p>Nom : ".$usager->getNom()."</p>";
                echo "<p>Prénom : ".$usager->getPrenom()."</p>";
                echo "<p>Signe astrologique : ".$usager->getZodiaque()."</p>";
                echo "<p>Date de naissance : ".$usager->getDdn()."</p>";
            ?>
        </div>
        <div class="infoComplémentaire">
            <?php
                echo "<p>Bio : ".$usager->getDescription()."</p>";
            ?>
        </div>

        <a href="modifierProfil.php">Modifier mon profil</a>
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
