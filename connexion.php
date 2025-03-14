<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <style>
        h2 {
            color: #fff;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php
session_start(); 


if (isset($_SESSION['admin_id'])) {
    header("Location: user.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "db11";
    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn) {
        die("Erreur lors de la connexion à la base de donnée : " . mysqli_connect_error());
    }


    $login =$_POST['login'];
    $password = $_POST['password'];


    $query = "SELECT id, login, password FROM admin WHERE login = '$login'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if ($row['password'] === $password) { 

            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['login'] = $row['login'];

            header("Location: user.php");
            exit();
        }     
    }
    else {
        $error_message = "Login ou mot de passe incorrect";
    }

    mysqli_close($conn);
}
?>

    <div class="connexion-container">
        <h2 style="color: #fff;">Connexion</h2>
        
        <?php 
            if (isset($error_message)) {
                $error_message;  
            } 
        ?>
        
        <form method="POST">
            <label for="login">Login :</label>
            <input type="text" id="login" name="login">

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password">

            <button type="submit">Se connecter</button>
        </form>
    </div>

</body>
</html>
