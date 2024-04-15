<?php
    session_start();
    require_once '../Usager.php';
    require_once '../Admin.php';
    if(!isset($_GET["id"])) {
        header('Location: messagerie.php');
        exit();
    }
    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
        $login = $usager->getLogin();
    } else if(isset($_SESSION["admin"])) {
        $admin = unserialize($_SESSION["admin"]);
        $login = $admin->getLogin();
    } else {
        header('Location: ../connexion.php');
        exit();
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    if($stmt = $mysqli->prepare("SELECT login1, login2 FROM Conversation WHERE id = ?")) {
        $stmt->bind_param("i", $_GET["id"]);
        $stmt->execute();
        $stmt->bind_result($login1, $login2);
        $stmt->fetch();
        if($login1 != $login && $login2 != $login) {
            header('Location: messagerie.php');
            exit();
        }
        $stmt->close();
    }

    $mysqli->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Conversation</title>
        <link rel="stylesheet" href="../css/conversation.css">
    </head>
    <body>
    <header>
    <div>
        <a href="../accueilUtilisateur.php">
            <img src="../css/img/logo.png" alt="Logo du site" id="LogoSite">
        </a>
        <h1>StarLove</h1>
    </div>
    <!-- Onglets à droite -->
    <div id="onglets">
        <ul>
            <li><a href="../profil.php">Profil</a></li>
            <li><a href="../recherche.php">Recherche</a></li>
            <li><a href="messagerie.php">Messages</a></li>
            <li><a href="../vuProfil.php">Qui a vu mon profil</a></li>
            <li><a href="../connexion.php">Déconnexion</a></li>
        </ul>  
    </div>
</header>
<main>
        <div id="conversation">
            <?php
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

                if (mysqli_connect_errno()) {
                    printf("Échec de la connexion : %s\n", mysqli_connect_error());
                    exit();
                }

                if($stmt = $mysqli->prepare("SELECT id, expediteur, receveur, date_envoi, contenu FROM Message WHERE conversation = ?")) {
                    $stmt->bind_param("i", $_GET["id"]);
                    $stmt->execute();
                    $stmt->bind_result($id, $expediteur, $receveur, $date_envoi, $contenu);
                    while($stmt->fetch()) {
                        if($expediteur == $login) {
                            echo "<div>";
                            echo "<h3 class='self'>$contenu</h3>";
                            echo "<p class='dateSelf'>$date_envoi</p>";
                            echo "<button class='suppr' data-message-id='".$id."'>Supprimer</button>";
                            echo "</div>";
                        }
                        if($receveur == $login) {
                            echo "<div>";
                            echo "<h3 class='other'>$contenu</h3>";
                            echo "<p class='dateOther'>$date_envoi</p>";
                            echo "<button class='sign' data-message-id='".$id."'>Signaler</button>";
                            echo "</div>";
                        }
                    }
                    $stmt->close();
                }
                
                $mysqli->close();
            ?>
        </div>
        <form id="formulaire">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
            <p>Contenu : <input type="text" name="contenu" required></p>
            <input type="submit" value="Envoyer">
        </form>
        <script src="../js/messagerie.js"></script>
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
