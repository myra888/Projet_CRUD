<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <header>
        <nav>
            <ul>
                <li><a href="connexion.php" class="button">Connexion</a></li>
                <li><a href="ajout.php" class="button">Ajouter un utilisateur</a></li>
            </ul>
        </nav>
    </header>


    <?php

        session_start();

        if (!isset($_SESSION['admin_id'])) {
            header("Location: connexion.php"); 
            exit();
        } 

        $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "db11";

        $conn = mysqli_connect($host, $user, $password, $dbname);

        if (!$conn) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }

        $query = "SELECT id, nom, prenom, login, password, profil FROM user";
        $result = mysqli_query($conn, $query);
    ?>


    <h2>Liste des utilisateurs</h2>
    <table border="1">
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Login</th>
            <th>Actions</th>
        </tr>
 
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['nom'] ?></td>
                <td><?= $row['prenom'] ?></td>
                <td><?= $row['login'] ?></td>
                <td><a href="voir.php?id=<?= $row['id'] ?>">Voir</a> <a href="update.php?id=<?= $row['id'] ?>">Modifier</a> <a href="delete.php?id=<?= $row['id'] ?>">Supprimer</a></td>
            </tr>

            <?php
                $id = $row['id'];
                $mot_de_passe_clair = $row['password'];
                $mot_de_passe_hache = md5($mot_de_passe_clair);
                $updateQuery = "UPDATE user SET password = '$mot_de_passe_hache' WHERE id = $id";
                mysqli_query($conn, $updateQuery);
            ?>
        <?php } ?>

    </table>

</body>
</html>

<?php
mysqli_close($conn);
?>
