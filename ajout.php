<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Page d'ajout</title>
</head>
<body>
    


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "db11";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $password = md5($_POST['password']);

    $doc = "photos/"; 
    $chemin = $doc . basename($_FILES["profil"]["name"]); 

    move_uploaded_file($_FILES["profil"]["tmp_name"], $chemin);


    $query = "INSERT INTO user (nom, prenom, login, password, profil) VALUES ('$nom', '$prenom', '$login', '$password', '$chemin')";
    if (mysqli_query($conn, $query)) {?>
            <p>Utilisateur ajouté avec succès.</p> 
            <p><a href='user.php'>Retour</a>
            <?php
    } else {
        echo "Erreur : " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


<form method="POST" enctype="multipart/form-data">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" ><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" ><br>

    <label for="login">Login :</label>
    <input type="text" id="login" name="login" ><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" ><br>

    <label for="profil">Photo de profil :</label>
    <input type="file" id="profil" name="profil""><br>

    <button type="submit">Ajouter l'utilisateur</button>
</form>
</body>
</html>