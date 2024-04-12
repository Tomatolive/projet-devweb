<?php
    session_start();
    require_once '../Usager.php';
    require_once '../Admin.php';

    if(!isset($_POST['message_id'])) {
        header('Location: messagerie.php');
        exit();
    }

    $messageId = $_POST['message_id'];

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    if($stmt = $mysqli->prepare("SELECT expediteur, receveur, contenu FROM Message WHERE id = ?")) {
        $stmt->bind_param("i", $messageId);
        $stmt->execute();
        $stmt->bind_result($expediteur, $destinataire, $contenu);
        $stmt->fetch();
        $stmt->close();
    }

    $success = false;
    if($stmt = $mysqli->prepare("INSERT INTO Signalement (message_id, message, plaintif, signale) VALUES (?, ?, ?, ?)")) {
        $stmt->bind_param("isss", $messageId, $contenu, $destinataire, $expediteur);
        $stmt->execute();
        $stmt->close();
        $success = true;
    }

    if ($success) {
        echo 'success';
    } else {
        echo 'error';
    }
?>
