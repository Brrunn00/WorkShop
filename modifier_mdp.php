<!doctype html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Modifier Mdp</title>
</head>
<body>

<div class="container py-2">
    <h4>Modifier Mdp</h4>
    <?php
    require_once 'database.php';
    $sqlState = $pdo->prepare('SELECT * FROM user WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);

    $category = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modifier'])) {
        $mdp = $_POST['mdp'];

        if (!empty($mdp)) {
            // Utilisation de la fonction de hachage md5 (non recommandée pour la sécurité)
            $hashedPassword = md5($mdp);
            
            $sqlState = $pdo->prepare('UPDATE user SET mdp = ?
                                            WHERE id = ?
                                            ');
            $sqlState->execute([$hashedPassword, $id]);
            header('location: voiruser.php');
        }
    }

    ?>
    <form method="post">
        <input type="hidden" class="form-control" name="id" value="<?php echo $category['id'] ?>">

        <label class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="mdp" value="<?php echo $category['mdp'] ?>">

        <input type="submit" value="Modifier mdp" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>
