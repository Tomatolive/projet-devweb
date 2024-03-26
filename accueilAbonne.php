<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        if($usager->getProfil() != "abonne") {
            if($usager->getProfil() == "utilisateur") {
                header('Location: accueilUtilisateur.php');
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
        <link rel="stylesheet" href="css/acceuilAbonne.css">
    </head>
    <body>
        <header>
            <a href="index.html">
                <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
        </header>

        <main> 
        <div id="menu">
            <ul>
                <li><a href="index.html"> Accueil </a></li>
                <li><a href="messagerie.php"> Messagerie </a></li>
                <li><a href="recherche.php"> Recherche</a></li>
            </ul>
        </div>
            <content>
            
            </content>
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

