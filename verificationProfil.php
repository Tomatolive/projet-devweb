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

    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($_FILES['imageFile']['name']); // Chemin complet du fichier sur le serveur

    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo 'Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.';
    }

    if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadFile)) {
        echo 'L\'image a été téléchargée avec succès.';
    } else {
        echo 'Une erreur est survenue lors du téléchargement de l\'image.';
    }

    if($stmt = $mysqli->prepare("UPDATE Usager SET nom = ?, prenom = ?, zodiaque = ?, ddn = ?, description = ?, image = ? WHERE login = ?")) {
        $nom_formate = $mysqli->real_escape_string($_POST["nom"]);
        $prenom_formate = $mysqli->real_escape_string($_POST["prenom"]);
        $zodiaque_formate = $mysqli->real_escape_string(Usager::setZodiaque($_POST["ddn"]));
        $ddn_formate = $mysqli->real_escape_string($_POST["ddn"]);
        $description_formate = $mysqli->real_escape_string($_POST["bio"]);
        $login_formate = $mysqli->real_escape_string($usager->getLogin());
        $image_formate = $mysqli->real_escape_string($uploadFile);
        $stmt->bind_param("sssssss", $nom_formate, $prenom_formate, $zodiaque_formate, $ddn_formate, $description_formate, $login_formate, $image_formate);
        $stmt->execute();
        $stmt->close();
        $usager->setNom($_POST["nom"]);
        $usager->setPrenom($_POST["prenom"]);
        $usager->setZodiaque2($_POST["ddn"]);
        $usager->setDdn($_POST["ddn"]);
        $usager->setDescription($_POST["bio"]);
        $usager->setImage($uploadFile);
        $_SESSION['usager'] = serialize($usager);
        header('Location: profil.php');
        exit();
    }

    $mysqli->close();
    header('Location: modifierProfil.php');
?>
