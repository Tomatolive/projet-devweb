<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
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
        header('Location: connexion.php');
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
    </head>
    <body>
        <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

            if (mysqli_connect_errno()) {
                printf("Échec de la connexion : %s\n", mysqli_connect_error());
                exit();
            }

            if($stmt = $mysqli->prepare("SELECT expediteur, receveur, date_envoi, contenu FROM Message WHERE conversation = ?")) {
                $stmt->bind_param("i", $_GET["id"]);
                $stmt->execute();
                $stmt->bind_result($expediteur, $receveur, $date_envoi, $contenu);
                while($stmt->fetch()) {
                    if($expediteur == $login) {
                        echo "<h3 class='self'>$contenu</h3>";
                        echo "<p>$date_envoi</p>";
                    }
                    if($receveur == $login) {
                        echo "<h3 class='other'>$contenu</h3>";
                        echo "<p>$date_envoi</p>";
                    }
                }
                $stmt->close();
            }
            
            $mysqli->close();
        ?>
        <form action="envoiMessage.php" method="post">
            <div id="formulaire">
                <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
                <p>Contenu : <input type="text" name="contenu" required></p>
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </body>
