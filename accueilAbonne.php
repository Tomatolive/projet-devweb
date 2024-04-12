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
