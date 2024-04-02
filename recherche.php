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
            <a href="accueilUtilisateur.html">
                <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
        </header>

        <main>
            <h2>Vous recherchez un profil ?</h2>
            <form action="resultatsRecherche.php" method="post">
                <input type="text" name="pseudonyme" placeholder="Pseudonyme" required>
                <select name="zodiaque">
                    <option value="">Selectionnez le signe du zodiaque</option>
                    <option value="Bélier">Bélier</option>
                    <option value="Taureau">Taureau</option>
                    <option value="Gémeaux">Gémeaux</option>
                    <option value="Cancer">Cancer</option>
                    <option value="Lion">Lion</option>
                    <option value="Vierge">Vierge</option>
                    <option value="Balance">Balance</option>
                    <option value="Scorpion">Scorpion</option>
                    <option value="Sagittaire">Sagittaire</option>
                    <option value="Capricorne">Capricorne</option>
                    <option value="Verseau">Verseau</option>
                    <option value="Poissons">Poissons</option> 
                </select>
                <input type="submit" value="Rechercher">
            </form>
        </main>
    </body>
</html>
