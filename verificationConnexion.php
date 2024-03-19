<?php
    session_start();

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    if($stmt = $mysqli->prepare("SELECT login, mdp, profil FROM Usager WHERE login = ?")) {
        $login_formate = $mysqli->real_escape_string($_POST["login"]);
        $stmt->bind_param("s", $login_formate);
        $stmt->execute();
        $stmt->bind_result($login, $mdp, $profil);
        $stmt->fetch();
        if($login == $_POST["login"] && $mdp == $_POST["mdp"]) {
            $_SESSION["login"] = $login;
            $_SESSION["mdp"] = $mdp;
            $_SESSION["profil"] = $profil;
            if($_SESSION["profil"] == "utilisateur") {
                header('Location: accueilUtilisateur.php');
                exit();
            }
            else if($_SESSION["profil"] == "abonne") {
                header('Location: accueilAbonne.php');
                exit();
            }
            else if($_SESSION["profil"] == "admin") {
                header('Location: accueilAdmin.php');
                exit();
            }
        }
        else {
            header('Location: connexion.php');
            exit();
        }
        $stmt->close();
    }

    $mysqli->close();
    header('Location: connexion.php');

?>
