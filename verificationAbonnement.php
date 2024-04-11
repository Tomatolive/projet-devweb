<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(!isset($_POST["abo"])) {
        header('Location: abonnement.php');
        exit();
    }

    if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
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

    if($stmt = $mysqli->prepare("UPDATE Usager SET date_fin_abonnement = ?, profil = 'abonne' WHERE login = ?")) {
        if($_POST["abo"] == 6) {
            $date = date('Y-m-d', strtotime('+6 month'));
            $stmt->bind_param("ss", $date, $usager->getLogin());
            $stmt->execute();
            $stmt->close();
            header('Location: connexion.php');
            exit();
        } else if($_POST["abo"] == 1) {
            $date = date('Y-m-d', strtotime('+1 year'));
            $stmt->bind_param("ss", $date, $usager->getLogin());
            $stmt->execute();
            $stmt->close();
            header('Location: connexion.php');
            exit();
        } else if($_POST["abo"] == 2) {
            $date = date('Y-m-d', strtotime('+2 year'));
            $stmt->bind_param("ss", $date, $usager->getLogin());
            $stmt->execute();
            $stmt->close();
            header('Location: connexion.php');
            exit();
        }
    }
?>
