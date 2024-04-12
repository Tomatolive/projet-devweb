<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';

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
        $stmt->close();
        if($login == $_POST["login"] && password_verify($_POST["mdp"], $mdp)) {
            if($profil == "utilisateur") {
                $stmt2 = $mysqli->prepare("SELECT sexe, date_inscription, nom, prenom, ddn, ville, profession, situation, description, informations, image FROM Usager WHERE login = ?");
                $stmt2->bind_param("s", $login_formate);
                $stmt2->execute();
                $stmt2->bind_result($sexe, $date_inscription, $nom, $prenom, $ddn, $ville, $profession, $situation, $description, $informations, $image);
                $stmt2->fetch();
                $usager = new Usager($login, $sexe, $date_inscription, null, $nom, $prenom, $ddn, $ville, $profession, $situation, $description, $informations, $profil, $image);
                $usager_serialized = serialize($usager);
                $_SESSION["usager"] = $usager_serialized;
                $stmt2->close();
                header('Location: accueilUtilisateur.php');
                exit();
            }
            else if($profil == "abonne") {
                $stmt2 = $mysqli->prepare("SELECT sexe, date_inscription, date_fin_abonnement, nom, prenom, ddn, ville, profession, situation, description, informations, image FROM Usager WHERE login = ?");
                $stmt2->bind_param("s", $login_formate);
                $stmt2->execute();
                $stmt2->bind_result($sexe, $date_inscription, $date_fin_abonnement, $nom, $prenom, $ddn, $ville, $profession, $situation, $description, $informations, $image);
                $stmt2->fetch();
                $usager = new Usager($login, $sexe, $date_inscription, $date_fin_abonnement, $nom, $prenom, $ddn, $ville, $profession, $situation, $description, $informations, $profil, $image);
                $usager_serialized = serialize($usager);
                $_SESSION["usager"] = $usager_serialized;
                $stmt2->close();
                header('Location: accueilAbonne.php');
                exit();
            }
            else if($profil == "admin") {
                $admin = new Admin($login);
                $admin_serialized = serialize($admin);
                $_SESSION["admin"] = $admin_serialized;
                header('Location: accueilAdmin.php');
                exit();
            }
        }
        else {
            header('Location: connexion.php?error=wrong');
            exit();
        }
    }

    $mysqli->close();
    header('Location: connexion.php');

?>
