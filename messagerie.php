<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';

    if(!isset($_SESSION["usager"]) && !isset($_SESSION["admin"])) {
        header('Location: connexion.php');
        exit();
    } else {
        if(isset($_SESSION["usager"])) {
            $usager = unserialize($_SESSION["usager"]);
            $login = $usager->getLogin();
            if($usager->getProfil() == "utilisateur") {
                header('Location: accueilUtilisateur.php');
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
                echo "<p><a href='conversation.php?id=$id'>Conversation avec $login2</a></p>";
            }
            if($login2 == $login) {
                echo "<p><a href='conversation.php?id=$id'>Conversation avec $login1</a></p>";
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
