<?php
    session_start();
    require_once 'Usager.php';
    if(!isset($_SESSION['usager'])){
        header('Location: connexion.php');
        exit();
    }
    $usager = unserialize($_SESSION['usager']);
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    if($stmt = $mysqli->prepare("UPDATE Usager SET nom = ?, prenom = ?, zodiaque = ?, ddn = ?, description = ? WHERE login = ?")) {
        $nom_formate = $mysqli->real_escape_string($_POST["nom"]);
        $prenom_formate = $mysqli->real_escape_string($_POST["prenom"]);
        $zodiaque_formate = $mysqli->real_escape_string(Usager::setZodiaque($_POST["ddn"]));
        $ddn_formate = $mysqli->real_escape_string($_POST["ddn"]);
        $description_formate = $mysqli->real_escape_string($_POST["bio"]);
        $login_formate = $mysqli->real_escape_string($usager->getLogin());
        $stmt->bind_param("ssssss", $nom_formate, $prenom_formate, $zodiaque_formate, $ddn_formate, $description_formate, $login_formate);
        $stmt->execute();
        $stmt->close();
        $usager->setNom($_POST["nom"]);
        $usager->setPrenom($_POST["prenom"]);
        $usager->setZodiaque2($_POST["ddn"]);
        $usager->setDdn($_POST["ddn"]);
        $usager->setDescription($_POST["bio"]);
        $_SESSION['usager'] = serialize($usager);
        header('Location: profil.php');
        exit();
    }

    $mysqli->close();
    header('Location: modifierProfil.php');
?>
