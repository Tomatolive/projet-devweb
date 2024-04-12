<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(isset($_SESSION["admin"])) {
        $admin = unserialize($_SESSION["admin"]);
        if($admin->getProfil() != "admin") {
            header('Location: connexion.php');
            exit();
        }
    } else if(isset($_SESSION["usager"])) {
        $usager = unserialize($_SESSION["usager"]);
    } else {
        header('Location: connexion.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Qui a vu mon profil ?</title>
        <link rel="stylesheet" href="css/vuProfil.css">
    </head>
    <body>
        <header>
            <div>
                <a href="accueilUtilisateur.php">
                    <img src="css/img/logo.png" alt="Logo du site" id="LogoSite">
                </a>
                <h1>StarLove</h1>
            </div>
            <!-- Onglets à droite -->
            <div id="onglets">
        <ul>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="recherche.php">Recherche</a></li>
            <li><a href="messagerie/messagerie.php">Messages</a></li>
            <li><a href="vuProfil.php">Qui a vu mon profil</a></li>
            <li><a href="connexion.php">Déconnexion</a></li>
        </ul>
    </div>
        </header>
        <main>
            <?php
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

                if (mysqli_connect_errno()) {
                    printf("Échec de la connexion : %s\n", mysqli_connect_error());
                    exit();
                }
                
                if($stmt = $mysqli->prepare("SELECT chercheur, date_recherche FROM Recherche WHERE recherche = ?")) {
                    $stmt->bind_param("s", $usager->getLogin()); 
                    $stmt->execute();
                    $stmt->bind_result($chercheur, $date_recherche);
                    echo "<h2>Ils ont consulté votre profil</h2>";
                    $res = false;
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Chercheur</th>";
                    echo "<th>Date de la recherche</th>";
                    echo "<th>Contacter</th>";
                    echo "</tr>";
                    while($stmt->fetch()) {
                        $res = true;
                        echo "<tr>";
                        echo "<td>$chercheur</td>";
                        echo "<td>$date_recherche</td>";
                        echo "<td><form action=\"messagerie/contacter.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"destinataire\" value=\"".$chercheur."\"></input>";
                        echo "<input type=\"hidden\" name=\"profil\" value=\"".$usager->getLogin()."\"></input>";
                        echo "<input type=\"submit\" value=\"Envoyer un message\"></input></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    if(!$res) {
                        echo "<p>Aucun résultat</p>";
                    }
                    $stmt->close();
                }
            ?>
        </main>
    </body>
</html>
