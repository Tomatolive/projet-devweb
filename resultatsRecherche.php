<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(!isset($_SESSION['usager'])){
        header('Location: connexion.php');
        exit();
    }    
    $usager = unserialize($_SESSION['usager']);
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
            <?php
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');
            
                if (mysqli_connect_errno()) {
                    printf("Échec de la connexion : %s\n", mysqli_connect_error());
                    exit();
                }
            
                if($stmt = $mysqli->prepare("SELECT login, zodiaque, nom, prenom, sexe, ddn, profil FROM Usager WHERE login = ?")) {
                    $login_formate = $mysqli->real_escape_string($_POST["pseudonyme"]);
                    $stmt->bind_param("s", $login_formate);
                    $stmt->execute();
                    $stmt->bind_result($login, $zodiaque, $nom, $prenom, $sexe, $ddn, $profil);
                    echo "<h2>Résultats de la recherche</h2>";
                    $res = false;
                    while($stmt->fetch()) {
                        if($profil != "admin") {
                            $res = true;
                            echo "<ul>";
                            echo "<li>Nom: $nom </li>";
                            echo "<li>Prénom: $prenom </li>";
                            echo "<li>Pseudonyme: $login</li>";
                            echo "<li>Signe du zodiaque: $zodiaque</li>";
                            echo "<li>Sexe: $sexe</li>";
                            echo "<li>Date de naissance: $ddn</li>";
                            echo "</ul>";
                            echo "<form action=\"messagerie/contacter.php\" method=\"post\">";
                            echo "<input type=\"hidden\" name=\"destinataire\" value=\"".$login."\"></input>";
                            echo "<input type=\"hidden\" name=\"profil\" value=\"".$profil."\"></input>";
                            echo "<input id=\"modif\" type=\"submit\" value=\"Envoyer un message\"></input>";
                        }
                    }
                    if(!$res) {
                        echo "<p>Aucun résultat ne correspond à votre recherche.</p>";
                    } else {
                        if($stmt2 = $mysqli->prepare("INSERT INTO Recherche (chercheur, recherche) VALUES (?, ?)")) {
                            $chercheur = $mysqli->real_escape_string($usager->getLogin());
                            $recherche = $mysqli->real_escape_string($login);
                            $stmt2->bind_param("ss", $chercheur, $recherche);
                            $stmt2->execute();
                            $stmt2->close();
                        }
                    }
                    $stmt->close();
                }
            ?>
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
