<!doctype html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Modifier Prix</title>
</head>
<body>
<?php include 'con_dbb.php' ?>
<div class="container py-2">
    <h4>Modifier Prix</h4>
    <?php
    require_once 'database.php';
    $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);

    $category = $sqlState->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['modifier'])) {
        $prix = $_POST['prix'];

        if (!empty($prix)) {
            $sqlState = $pdo->prepare('UPDATE produit SET prix = ?
                                            WHERE id = ?
                                            ');
            $sqlState->execute([$prix, $id]);
            header('location: voirstock.php');
        }
    }

    ?>
    <form method="post">
        <input type="hidden" class="form-control" name="id" value="<?php echo $category['id'] ?>">

        <label class="form-label">Prix</label>
        <textarea class="form-control" name="prix"><?php echo $category['prix'] ?></textarea>

        <input type="submit" value="Modifier Prix" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>