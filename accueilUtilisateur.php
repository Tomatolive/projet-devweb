<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        if($usager->getProfil() != "utilisateur") {
            if($usager->getProfil() == "abonne") {
                header('Location: accueilAbonne.php');
                exit();
            } else {
                header('Location: connexion.php');
                exit();
            }
        }
    } else if(isset($_SESSION["admin"])) {
        $admin = unserialize($_SESSION["admin"]);
        if($admin->getProfil() == "admin") {
            header('Location: accueilAdmin.php');
            exit();
        } else {
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
        <meta charset="utf-8">
        <title>Page de connexion</title>
        <link rel="stylesheet" href="css/acceuilUtilisateur.css">
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
            <li><a href="connexion.php">Déconnexion</a></li>
        </ul>
    </div>
</header>

        <main>
                <h2>Discuter avec vos futurs partenaires</h2>
                <li><a href="abonnement.php">S'abonner</a></li>
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
