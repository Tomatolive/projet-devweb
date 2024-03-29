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
    <link rel="stylesheet" href="css/accueilAdmin.css">
</head>
<body>
<header>
    <div>
        <a href="accueilUtilisateur.php">
            <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
        </a>
        <h1>StarLove</h1>
    </div>
    <!-- Onglets à droite -->
    <div id="onglets">
        <ul>
            <li><a href="#">Messages</a></li>
            <li><a href="#">Consultations de profil</a></li>
            <li><a href="#">Mon profil</a></li>
            <li><a href="#">Qui a vu mon profil</a></li>
        </ul>
    </div>
</header>
<!-- Suggestion de profil -->
<main>
    <div class="profile-container">
        <h2 id="accueil">Suggestion Profil</h2>
        
        <div class="bouton">
            <button class="contact-button">Contacter</button>
            <button class="suivant-button">Suivant</button>
        </div>
    </div>
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
