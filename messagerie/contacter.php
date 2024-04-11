<?php
    session_start();
    require_once '../Usager.php';
    require_once '../Admin.php';
    if(isset($_SESSION['usager'])){
        $usager = unserialize($_SESSION["usager"]);
    }

    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    if(isset($_POST["admin"])) {
        if($stmt = $mysqli->prepare("SELECT login FROM Usager WHERE profil = 'admin'")) {
            $stmt->execute();
            $stmt->bind_result($login);
            $stmt->fetch();
            $stmt->close();
        }

        if($stmt = $mysqli->prepare("INSERT INTO Conversation (login1, login2) VALUES (?, ?)")) {
            $stmt->bind_param("ss", $usager->getLogin(), $login);
            $stmt->execute();
            $stmt->close();
            header('Location: messagerie.php');
            exit();
        }
    } else {
        if($_POST["profil"] == "utilisateur" || $usager->getProfil() == "utilisateur") {
            if($_POST["profil"] == "utilisateur") {
                echo "L'utilisateur que vous essayez de contacter n'est pas abonné.";
                echo "<a href=\"../recherche.php\">Retour à la recherche</a>";
                exit();
            } else if($usager->getProfil() == "utilisateur") {
                echo "Vous devez être abonné pour contacter un autre utilisateur.";
                echo "<a href=\"../recherche.php\">Retour à la recherche</a>";
                exit();
            }
        }
        if($_POST["destinataire"] == $usager->getLogin()) {
            echo "Vous ne pouvez pas vous envoyer un message à vous-même.";
            echo "<a href=\"../recherche.php\">Retour à la recherche</a>";
            exit();
        }

        if($stmt = $mysqli->prepare("INSERT INTO Conversation (login1, login2) VALUES (?, ?)")) {
            $stmt->bind_param("ss", $usager->getLogin(), $_POST["destinataire"]);
            $stmt->execute();
            $stmt->close();
            header('Location: messagerie.php');
            exit();
        }
    }
?>
