<!doctype html>
<html lang="en">
<head>
    <?php include 'head.php' ?>
    <title>Modifier Stock</title>
</head>
<body>
<div class="container py-2">
    <h4>Modifier Stock</h4>
    <?php
    require_once 'database.php';
    $sqlState = $pdo->prepare('SELECT * FROM produit WHERE id=?');
    $id = $_GET['id'];
    $sqlState->execute([$id]);
    $category = $sqlState->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['modifier'])) {
        $quantite = $_POST['quantite'];

        if (!empty($quantite)) {
            $sqlState = $pdo->prepare('UPDATE produit SET quantite = ?
                                            WHERE id = ?
                                            ');
            $sqlState->execute([$quantite, $id]);
            header('location: voirstock.php');
        }
    }

    ?>
    <form method="post">
        <input type="hidden" class="form-control" name="id" value="<?php echo $category['id'] ?>">

        <label class="form-label">Quantité</label>
        <textarea class="form-control" name="quantite"><?php echo $category['quantite'] ?></textarea>

        <input type="submit" value="modifier" class="btn btn-primary my-2" name="modifier">
    </form>
</div>

</body>
</html>