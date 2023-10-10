<?php
if(isset($_POST['username']) && isset($_POST['password']))
{
    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
		   
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db,htmlspecialchars($_POST['username'])); 
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));

    session_start($db);
    
        if(isset($_POST['username']) and isset($_POST['email']) and isset($_POST['password']))
        {
            
            $db -> exec ("INSERT INTO user (id,mdp,mail) VALUES(?, ?, ?)");
            $db -> array($_POST['username'], $_POST['email'], $_POST['password'] ));
            header('Location: voiruser.php');
        }
        else
        {
           header('Location: creauser.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }}
    mysqli_close($db);
     // fermer la connexion
?>