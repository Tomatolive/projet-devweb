
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
            <li><a href="../profil.php">Profil</a></li>
            <li><a href="../recherche.php">Recherche</a></li>
            <li><a href="messagerie.php">Messages</a></li>
            <li><a href="#">Qui a vu mon profil</a></li>
            <li><a href="../connexion.php">Déconnexion</a></li>
        </ul>
    </div>
        </header>

        <main>
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

    // if($stmt2 = $mysqli->prepare("INSERT INTO Message (login_expediteur, login_destinataire, date_envoi, contenu) VALUES (?, ?, NOW(), ?)")) {
    //     $login_expediteur_formate = $mysqli->real_escape_string($usager->login);
    //     $login_destinataire_formate = $mysqli->real_escape_string($_POST["destinataire"]);
    //     $contenu_formate = $mysqli->real_escape_string($_POST["contenu"]);
    //     $stmt2->bind_param("sss", $login_expediteur_formate, $login_destinataire_formate, $contenu_formate);
    //     $stmt2->execute();
    //     $stmt2->close();
    //     header('Location: accueilUtilisateur.php');
    //     exit();
    // }

    $mysqli->close();
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
