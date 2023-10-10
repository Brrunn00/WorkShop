<?php
session_start();

// Fonction personnalisée pour comparer les chaînes en toute sécurité
function compareStrings($str1, $str2) {
    $len1 = strlen($str1);
    $len2 = strlen($str2);

    // Comparez les longueurs pour éviter la divulgation de la longueur
    $len = min($len1, $len2);

    $result = 0;

    for ($i = 0; $i < $len; $i++) {
        $result |= (ord($str1[$i]) ^ ord($str2[$i]));
    }

    $result |= ($len1 ^ $len2);

    return ($result === 0);
}

if(isset($_POST['username']) && isset($_POST['password']))
{
    // Connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
           or die('Could not connect to the database');
		   
    // Échappez et sécurisez les entrées de l'utilisateur
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = $_POST['password'];

    if($username !== "" && $password !== "")
    {
        // Recherchez l'utilisateur dans la base de données
        $query = "SELECT id, mdp FROM user WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $storedPasswordHash = $row['mdp'];

            // Utilisez la fonction personnalisée pour vérifier le mot de passe
            if (compareStrings($storedPasswordHash, md5($password))) {
                $_SESSION['username'] = $username;
                header('Location: profil.php');
            } else {
                header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
            }
        } else {
            header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: login.php'); // redirection
}
mysqli_close($db); // fermer la connexion
?>
