<?php
    session_start();

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    if($stmt = $mysqli->prepare("SELECT login FROM Usager WHERE login = ?")) {
        $login_formate = $mysqli->real_escape_string($_POST["login"]);
        $stmt->bind_param("s", $login_formate);
        $stmt->execute();
        $stmt->bind_result($login);
        $stmt->fetch();
        if($login == $_POST["login"]) {
            header('Location: inscription.php?error=wrong');
            exit();
        } else {
            if($stmt2 = $mysqli->prepare("INSERT INTO Usager (login, mdp, sexe, date_inscription, profil, nom, prenom) VALUES (?, ?, ?, CURDATE(), ?, ?, ?)")) {
                $login_formate = $mysqli->real_escape_string($_POST["login"]);
                $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
                $mdp_formate = $mysqli->real_escape_string($mdp);
                $sexe_formate = $mysqli->real_escape_string($_POST["sexe"]);
                $profil_formate = $mysqli->real_escape_string("utilisateur");
                $nom_formate = $mysqli->real_escape_string($_POST["nom"]);
                $prenom_formate = $mysqli->real_escape_string($_POST["prenom"]);
                $stmt2->bind_param("ssssss", $login_formate, $mdp_formate, $sexe_formate, $profil_formate, $nom_formate, $prenom_formate);
                $stmt2->execute();
                $stmt2->close();
                header('Location: connexion.php');
                exit();
            }
        }
        $stmt->close();
    }

    $mysqli->close();
    header('Location: inscription.php');

?>
