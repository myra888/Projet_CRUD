<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Infos</title>
</head>
<body>
    
<?php

    if (isset($_GET['id'])) {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "db11";

        $conn = mysqli_connect($host, $user, $password, $dbname);

        if (!$conn) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }

        $id = $_GET['id'];

        $query = "SELECT nom, prenom, login, password, profil FROM user WHERE id = $id";

        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {?>
            <div class="details" >
                <h1 style="margin-bottom : 90px; margin-top : 30px;">Détails de l'utilisateur</h1>
                <img src="<?= $user['profil'] ?>">
                <p><strong>Nom :</strong> <?= $user['nom'] ?> </p>
                <p><strong>Prénom :</strong> <?= $user['prenom'] ?> </p>
                <p><strong>Login :</strong> <?= $user['login'] ?> </p>;
                <p><strong>Mot de passe :</strong> <?= $user['password'] ?> </p>
                
            </div>
            <?php 
        } else {
            echo "Utilisateur non trouvé !";
        }

        mysqli_close($conn);
    }
?>
</body>
</html>