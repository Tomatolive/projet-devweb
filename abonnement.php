<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        $login = $usager->getLogin();
        $profil = $usager->getProfil();
        if($profil != "utilisateur") {
            header('Location: accueilUtilisateur.php');
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
        <title>Abonnement</title>
        <link rel="stylesheet" href="css/abonnement.css">
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
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                </ul>
            </div>
        </header>
        <h2>Abonnement</h2>
        <div id="abonnement">
            <form action="verificationAbonnement.php" method="post">
                <select name="abo">
                    <option value="">Selectionnez une durée d'abonnement</option>
                    <option label="6 mois" value="6">6 mois</option>
                    <option label="1 an" value="1">1 an</option>
                    <option label="2 ans" value="2">2 ans</option>
                </select>
                <input type="submit" value="S'abonner">
            </form>
        </div>
    </body>
</html>
