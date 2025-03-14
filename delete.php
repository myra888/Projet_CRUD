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


    $query = "DELETE FROM user WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: user.php"); 
        exit();
    } else {
        echo "Erreur!!";
    }

    mysqli_close($conn);
}
?>
