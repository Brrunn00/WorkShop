<?php
// Connexion à la base de données
$db_username = 'root';
$db_password = '';
$db_name     = 'gestionstock_bdd';
$db_host     = 'localhost';
$con = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('could not connect to database');

// Vérification si l'id est présent dans la requête GET
if (isset($_GET['id'])) {
    // Récupération de l'id à supprimer
    $id = $_GET['id'];

    // Requête SQL pour supprimer la ligne de la table "user" correspondant à l'id
    $sql = "DELETE FROM produit WHERE id = '$id'";

    // Exécution de la requête
    if (mysqli_query($con, $sql)) {
        // Redirection vers la page voiruser.php après la suppression
        header('Location: voirstock.php');
        exit();
    } else {

        echo "Erreur lors de la suppression : " . mysqli_error($con);
    }
}

// Fermeture de la connexion à la base de données
mysqli_close($con);
?>
