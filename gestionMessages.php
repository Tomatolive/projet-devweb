
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Page de connexion</title>
        <link rel="stylesheet" href="css/gestionMessages.css">
    </head>
    <body>
        <header>
            <a href="accueilAdmin.php">
                <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
            </a>
            <h1>StarLove</h1>
        </header>

        <main>    
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

    if($stmt = $mysqli->prepare("SELECT plaintif, signale, message FROM Signalement")) {
        $stmt->execute();
        $stmt->bind_result($plaintif, $signale, $message);
        echo "<table>";
        echo "<tr><th>Plaignant</th><th>Signalé</th><th>Message</th></tr>";
        while ($stmt->fetch()) {
            echo "<tr><td>$plaintif</td><td>$signale</td><td>$message</td></tr>";
        }
        $stmt->close();
    }
?>
        </main>

        
    </body>
</html>
