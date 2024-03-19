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
                <select name="sexe">
                    <option value="">Selectionnez votre sexe</option>
                    <option label="H" value="H">Homme</option>
                    <option label="F" value="F">Femme</option>
                    <option label="A" value="A">Autre</option>
                </select>
                <input type="submit" value="S'inscrire">
            </div>
        </form>
    </body>
</html>
