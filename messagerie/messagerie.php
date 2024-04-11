<?php
    session_start();
    require_once '../Usager.php';
    require_once '../Admin.php';

    if(!isset($_SESSION["usager"]) && !isset($_SESSION["admin"])) {
        header('Location: ../connexion.php');
        exit();
    } else {
        if(isset($_SESSION["usager"])) {
            $usager = unserialize($_SESSION["usager"]);
            $login = $usager->getLogin();
            if($usager->getProfil() == "utilisateur") {
                header('Location: ../accueilUtilisateur.php');
                exit();
            }
        } else if(isset($_SESSION["admin"])) {
            $admin = unserialize($_SESSION["admin"]);
            $login = $admin->getLogin();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>messagerie</title>
        <link rel="stylesheet" href="../css/messagerie.css">
    </head>
    <body>
        <header>
            <a href="index.html">
                <img src="../css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
            <div id="onglets">
        <ul>
            <?php
                if(isset($_SESSION["admin"])) {
                    echo "<li><a href=\"../admin.php\">Admin</a></li>";
                } else {
                    echo '<li><a href="../profil.php">Profil</a></li>';
                    echo '<li><a href="../recherche.php">Recherche</a></li>';
                    echo '<li><a href="messagerie.php">Messages</a></li>';
                    echo '<li><a href="#">Qui a vu mon profil</a></li>';
                    echo '<li><a href="../connexion.php">Déconnexion</a></li>';
                }
            ?>
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

            if($stmt = $mysqli->prepare("SELECT id, login1, login2 FROM Conversation WHERE login1 = ? OR login2 = ?")) {
                $login_formate = $mysqli->real_escape_string($login);
                $stmt->bind_param("ss", $login_formate, $login_formate);
                $stmt->execute();
                $stmt->bind_result($id, $login1, $login2);
                while($stmt->fetch()) {
                    if($login1 == $login) {
                        echo "<p class=\"conversation\"><a href='conversation.php?id=$id'>Conversation avec $login2</a></p>";
                    }
                    if($login2 == $login) {
                        echo "<p class=\"conversation\"><a href='conversation.php?id=$id'>Conversation avec $login1</a></p>";
                    }
                }
                $stmt->close();
            }

            $mysqli->close();

            if(!isset($_SESSION["admin"])) {
                echo "<form action=\"contacter.php\" method=\"post\">";
                echo "<input type=\"hidden\" name=\"profil\" value=\"admin\"></input>";
                echo "<input id=\"modif\" type=\"submit\" value=\"Contacter un admin\"></input>";
                echo "</form>";
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
