<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page de connexion</title>
        <link rel="stylesheet" href="css/connexion.css">
    </head>
    <body>
        <header>
            <img src="img/logo.png" alt="Logo du site" id="LogoSite">
            <h1>nom du site</h1>
        </header>

        <main>    
            <form action="verificationConnexion.php" method="post">
                <div id="formulaire">
                    <p>Login : <input type="text" name="login" required></p>
                    <p>Mot de passe : <input type="text" name="mdp" required></p>
                    <input type="submit" value="Se connecter">
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
