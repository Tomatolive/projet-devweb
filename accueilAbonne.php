<?php
    session_start();
    require_once 'Usager.php';
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        if($usager->getProfil() != "abonne") {
            if($usager->getProfil() == "utilisateur") {
                header('Location: accueilUtilisateur.php');
            } else if($usager->getProfil() == "administrateur") {
                header('Location: accueilAdministrateur.php');
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
    <link rel="stylesheet" href="css/acceuilAbonne.css">
</head>
<body>
<header>
    <div>
        <a href="accueilUtilisateur.php">
            <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
        </a>
        <h1>StarLove</h1>
        <!-- Message d'accueil -->
        <h2 id="accueil">Suggestion Profil</h2>
    </div>
    <!-- Onglets à droite -->
    <div id="onglets">
        <ul>
            <li><a href="#">Messages</a></li>
            <li><a href="#">Consultations de profil</a></li>
            <li><a href="#">Mon profil</a></li>
            <li><a href="#">Qui a vu mon profil</a></li> <!-- Nouvel onglet -->
        </ul>
    </div>
</header>
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
<!-- Suggestion de profil -->
<div class="profile-container">
    <img src="css/img/homme.jpg" alt="Profil" class="profile-image">
    <!-- Bouton contact -->
    <button class="contact-button">Contacter</button>
    <!-- Bouton suivant -->
    <button class="suivant-button">Suivant</button>
</div>
</body>
</html>
