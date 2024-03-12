<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page de connexion</title>
    </head>
    <body>
        <h1>Bienvenue sur la page d'accueil</h1>

        <form action="verificationConnexion.php" method="post">
            <div id="formulaire">
                <p>Login : <input type="text" name="login" required></p>
                <p>Mot de passe : <input type="text" name="mdp" required></p>
                <input type="submit" value="Se connecter">
            </div>
        </form>
    </body>
</html>
