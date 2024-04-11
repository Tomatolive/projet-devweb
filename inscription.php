<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page d'inscription</title>
        <link rel="stylesheet" href="css/inscription.css">
        <script src="js/inscription.js"></script>
    </head>
    <body>
    <header>
            <a href="index.html">
                <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
        </header>
        
        <main>
        <h1>Rejoignez les étoiles</h1>
        <?php 
            if(isset($_GET["error"]) && $_GET["error"] == "wrong") { 
                echo "<p>Le login est déjà utilisé, veuillez en choisir un autre.</p>";
            }
        ?>

        <form action="verificationInscription.php" method="post">
            <div id="formulaire">
                <p>Login : <input type="text" name="login" required></p>
                <p>Mot de passe : <input type="text" name="mdp" required></p>
                <p>Nom : <input type="text" name="nom" required></p>
                <p>Prénom : <input type="text" name="prenom" required></p>
                <p>Date de naissance : <input type="date" id="ddn" name="ddn" min="1900-01-01" required pattern="\d{4}-\d{2}-\d{2}"></p>
                <select name="sexe">
                    <option value="">Selectionnez votre sexe</option>
                    <option label="Homme" value="H">Homme</option>
                    <option label="Femme" value="F">Femme</option>
                    <option label="Autre" value="A">Autre</option>
                </select>
                <input type="submit" value="S'inscrire">
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
