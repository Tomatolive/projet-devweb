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
        <div id="boutons">
        <ul>
            <li><a href="gestionMessages.php">Gestion des messages</a></li>
            <li><a href="gestionProfils.php">Gestion des profils</a></li>
        </ul>
    </div>
    <!-- Onglets à droite -->
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
<!-- Suggestion de profil -->
<main>
    
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


