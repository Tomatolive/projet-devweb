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

    if($stmt = $mysqli->prepare("SELECT login, nom, prenom FROM Usager")) {
        $stmt->execute();
        $stmt->bind_result($login, $nom, $prenom);
        echo "<table>";
        echo "<tr><th>Login</th><th>Nom</th><th>Prenom</th></tr>";
        while ($stmt->fetch()) {
            echo "<tr><td>$login</td><td>$nom</td><td>$prenom</td>";
            echo "<td><form action=\"bannir.php\" method=\"post\">";
            echo "<input type=\"hidden\" name=\"banni\" value=\"".$login."\"></input>";
            echo "<input type=\"submit\" value=\"Bannir\"></input></td>";
        }
        $stmt->close();
    }
?>
