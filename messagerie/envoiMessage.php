<?php
    session_start();
    require_once '../Usager.php';
    require_once '../Admin.php';

    if(!isset($_POST["contenu"]) || !isset($_POST["id"])) {
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
        $stmt->bind_param("i", $_POST["id"]);
        $stmt->execute();
        $stmt->bind_result($login1, $login2);
        $stmt->fetch();
        if($login1 != $login && $login2 != $login) {
            header('Location: messagerie.php');
            exit();
        }
        $stmt->close();
    }

    if($stmt2 = $mysqli->prepare("INSERT INTO Message (expediteur, receveur, date_envoi, contenu, conversation) VALUES (?, ?, NOW(), ?, ?)")) {
        if($login == $login1) {
            $stmt2->bind_param("sssi", $login, $login2, $_POST["contenu"], $_POST["id"]);
        } else {
            $stmt2->bind_param("sssi", $login, $login1, $_POST["contenu"], $_POST["id"]);
        }
        $succes = $stmt2->execute();
        $stmt2->close();
    }

    $mysqli->close();

    if($succes) {
        $reponse = array('succes' => $succes, 'nvMessage' => "<h3>".$_POST["contenu"]."</h3>");
    }

    header('Content-Type: application/json');
    echo json_encode($reponse);
?>
