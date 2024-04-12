<?php
    session_start();
    require_once 'Admin.php';
    if(!isset($_SESSION['admin'])){
        header('Location: connexion.php');
        exit();
    }
    $admin = unserialize($_SESSION['admin']);
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    $login = $_POST['banni'];
    if($stmt = $mysqli->prepare("DELETE FROM Usager WHERE login = ?")) {
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: gestionProfils.php');
    exit();
?>
