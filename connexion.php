<?php
    session_start();
    $_SESSION = array();
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page de connexion</title>
        <link rel="stylesheet" href="css/connexion.css">
    </head>
    <body>
        <header>
            <a href="index.html">
                <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
        </header>

        <main>    
            <?php 
                if(isset($_GET["error"]) && $_GET["error"] == "wrong") { 
                    echo "<p>Le login ou le mot de passe est incorrect. Veuillez réessayer.</p>";
                }
            ?>
            <form action="verificationConnexion.php" method="post">
                <div id="formulaire">
                    <div class="champ">
                        <label for="identifiant">Identifiant:</label>
                        <input type="text" name="login" required>
                    </div>
                    <div class="champ">
                        <label for="motdepasse">Mot de passe:</label>
                        <input type="password" name="mdp" required>
                    </div>
                    <button type="submit" value="Se connecter">Se connecter</button>
                </div>
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
