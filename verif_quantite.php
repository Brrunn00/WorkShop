<?php
session_start();
// Vérifier que les données ont été envoyées par le formulaire
if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['quantite']) && isset($_POST['img']) && isset($_POST['user'])) {

    // Récupérer les données de la page précédente
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $img = $_POST['img'];
    $user = $_POST['user'];
    $quantite = $_POST['quantite'];

    // Connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $con = mysqli_connect($db_host, $db_username, $db_password, $db_name)
           or die('Could not connect to database');


// Vérification de la quantité sélectionnée 
// Quantité sélectionnée par l'utilisateur
$requete = $connexion->prepare("SELECT quantite FROM produit WHERE id = id");
$requete->bindParam('id', $id);
$requete->execute();
$quantite_disponible = $requete->fetchColumn();

if ($quantite <= $quantite_disponible) {
    // Redirection vers la page "ajouter_paniertest.php"
    header("Location: ajouter_panier.php");
} else {
    // Redirection vers la page "commande.php"
    header("Location: commande.php");
}
?>