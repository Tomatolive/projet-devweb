<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(!isset($_SESSION['usager'])){
        header('Location: connexion.php');
        exit();
    }
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Recherche</title>
        <link rel="stylesheet" href="css/recherche.css">
    </head>
    <body>
        <header>
            <a href="accueilUtilisateur.php">
                <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
            <div id="onglets">
        <ul>
            <li><a href="../profil.php">Profil</a></li>
            <li><a href="../recherche.php">Recherche</a></li>
            <li><a href="messagerie/messagerie.php">Messages</a></li>
            <li><a href="#">Qui a vu mon profil</a></li>
            <li><a href="connexion.php">Déconnexion</a></li>
        </ul>
    </div>
        </header>

        <main>
            <h2>Vous recherchez un profil ?</h2>
            <form action="resultatsRecherche.php" method="post">
                <input type="text" name="pseudonyme" placeholder="Pseudonyme" required>
                <input type="submit" value="Rechercher">
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
