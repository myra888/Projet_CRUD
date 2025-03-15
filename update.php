<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page modification</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "db11";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM user WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $login = $row['login'];
        } else {
            echo "Utilisateur non trouvé.";
            exit;
        }
    }

    if (isset($_POST['update'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password = md5($password);

        $updateQuery = "UPDATE user SET nom='$nom', prenom='$prenom', login='$login', password='$password' WHERE id=$id";

        if (mysqli_query($conn, $updateQuery)) { ?>
            <p>Mise à jour réussie !</p> 
            <p><a href='user.php'>Retour</a>
            <?php
        } else {
            echo "Erreur : " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>



    <h2>Modifier Utilisateur</h2>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= $nom ?>" ><br><br>

        <label>Prénom :</label>
        <input type="text" name="prenom" value="<?= $prenom ?>" ><br><br>

        <label>Login :</label>
        <input type="text" name="login" value="<?= $login ?>" ><br><br>

        <label>Nouveau mot de passe :</label>
        <input type="password" name="password"><br><br>

        <button type="submit" name="update">Mettre à jour</button>
    </form>

</body>
</html>
