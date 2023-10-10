<!doctype html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Modifier Nom</title>
</head>
<body>
<?php include 'nav.php' ?>
<div class="container py-2">
    <h4>Modifier Nom</h4>
    <?php
    require_once 'database.php';
    $sqlState = $pdo->prepare('SELECT * FROM user WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);

    $category = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modifier'])) {
        $pseudo = $_POST['pseudo'];

        if (!empty($pseudo)) {
            $sqlState = $pdo->prepare('UPDATE user SET pseudo = ?
                                            WHERE id = ?
                                            ');
            $sqlState->execute([$pseudo, $id]);
            header('location: voiruser.php');
        }
    }

    ?>
    <form method="post">
        <input type="hidden" class="form-control" name="id" value="<?php echo $category['id'] ?>">

        <label class="form-label">Nom</label>
        <textarea class="form-control" name="pseudo"><?php echo $category['pseudo'] ?></textarea>

        <input type="submit" value="Modifier nom" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>