<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page d'inscription</title>
    </head>
    <body>
        <h1>Bienvenue sur la page d'inscription</h1>

        <form action="verificationInscription.php" method="post">
            <div id="formulaire">
                <p>Login : <input type="text" name="login" required></p>
                <p>Mot de passe : <input type="text" name="mdp" required></p>
                <p>Nom : <input type="text" name="nom" required></p>
                <p>Prénom : <input type="text" name="prenom" required></p>
                <fieldset class="gender">
                    <legend>Sexe</legend>
                    <input type="radio" value="homme" checked />
                    <label for="homme">Homme</label>
                    <input type="radio" value="femme"/>
                    <label for="femme">Femme</label>
                    <input type="radio" value="autre"/>
                    <label for="autre">Autre</label>
                </fieldset>
                <input type="submit" value="S'inscrire">
            </div>
        </form>
    </body>
</html>
