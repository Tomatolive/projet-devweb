<?php
    session_start();
    require_once 'Usager.php';
    require_once 'Admin.php';
    if(!isset($_SESSION['usager'])){
        header('Location: connexion.php');
        exit();
    }

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli('localhost', 'devweb', '$iteDeR3nc0ntre', 'rencontre');

    if (mysqli_connect_errno()) {
        printf("Échec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }

    if($stmt = $mysqli->prepare("SELECT login, zodiaque, nom, prenom, sexe, ddn, profil FROM Usager WHERE login = ?")) {
        $login_formate = $mysqli->real_escape_string($_POST["pseudonyme"]);
        $stmt->bind_param("s", $login_formate);
        $stmt->execute();
        $stmt->bind_result($login, $zodiaque, $nom, $prenom, $sexe, $ddn, $profil);
        echo "<h2>Résultats de la recherche</h2>";
        $res = false;
        while($stmt->fetch()) {
            if($profil != "admin") {
                $res = true;
                echo "<p>Profil de $prenom $nom :</p>";
                echo "<ul>";
                echo "<li>Pseudonyme : $login</li>";
                echo "<li>Signe du zodiaque : $zodiaque</li>";
                echo "<li>Sexe : $sexe</li>";
                echo "<li>Date de naissance : $ddn</li>";
                echo "</ul>";
            }
        }
        if(!$res) {
            echo "<p>Aucun résultat ne correspond à votre recherche.</p>";
        }
        $stmt->close();
    }
?>
