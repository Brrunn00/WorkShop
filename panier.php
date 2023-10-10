<?php 
//connexion à la base de données
$db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
//verifier la connexion
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>GESTSTOCK</title>
    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/profil.css">
    <link href="assets/css/stock.css" rel="stylesheet">
</head>
<body>
<header class="main-header clearfix" role="header">
    <div class="logo">
        <a href="profil.php"><em>GEST</em> STOCK</a>
    </div>
    
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
        <ul class="main-menu">
            <li>
                <a href="panier.php">
                    <img class="img-fluid" width="30" src="img/panier.png">
                    <span class="label label-warning pull-right r-activity">
                        <?php
                        // Assurez-vous que $_SESSION et $con sont correctement définis
                        session_start();
                        $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
                        
                        if (isset($_SESSION['username'])) {
                            $user = $_SESSION['username'];
                            // Faites la requête pour récupérer le nombre de lignes de la table panier pour l'utilisateur connecté
                            $query = "SELECT COUNT(*) AS count FROM panier WHERE id_utilisateur = '$user'";
                            $result = mysqli_query($con, $query);

                            if ($result) {
                                $row = mysqli_fetch_assoc($result);
                                $rowCount = $row['count'];
                                echo $rowCount; // Affiche le nombre de lignes
                            } else {
                                echo "Erreur lors de l'exécution de la requête : " . mysqli_error($con);
                            }
                        } else {
                            echo "Erreur : Session non définie.";
                        }
                        ?>
                    </span>
                </a>
                <ul class="sub-menu"></ul>
            </li>

            <li class="external">
                <a href="#section2">
                    <?php
                    if (isset($_SESSION['username']) && $_SESSION['username'] !== "") {
                        $user = $_SESSION['username'];
                        // afficher un message
                        echo "$user";
                    }
                    ?>
                </a>
                <ul class="sub-menu">
                    <?php
                    // Assurez-vous que la variable $etat est définie avant de la vérifier
                    if (isset($etat)) {
                        // Afficher le lien vers la page profil_user.php si l'état de l'utilisateur est "user"
                        if ($etat == "user") {
                            echo '<li><a href="profil_user.php">Profil</a></li>';
                        } else {
                            echo '<li><a href="page_profil.php">Profil</a></li>';
                        }
                    }
                    ?>
                    <li><a href="page_profil.php">Profil</a></li>
                    <li><a href="panier.php">Panier</a></li>
                    <li><a href="login.php" rel="sponsored" class="external">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>



<section class="container">
    <div style="margin: 130px 50px 30px 530px"></div>
    <h2> Panier</h2>
    <br>
    <?php 
    // Connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $con = mysqli_connect($db_host, $db_username, $db_password, $db_name) or die('could not connect to database');

    // Récupération des données de la table "panier" pour l'utilisateur connecté
    $sql = "SELECT * FROM panier WHERE id_utilisateur = '$user'";
    $result = mysqli_query($con, $sql);

    // Vérification s'il y a des données dans la table "panier"
    if(mysqli_num_rows($result) > 0) {
    ?>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> </th>
                            <th class="text-center">nom</th>
                            <th class="text-center">quantite</th>
                            <th class="text-center">prix</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Récupérer et additionner toutes les valeurs de la colonne "quantite"
                        $total_quantite = 0; // Variable pour stocker la somme des quantités
                        $total = 0; // Variable pour stocker le total
                        while($row = mysqli_fetch_assoc($result)) {
                            $total_quantite += $row['quantite'];
                            $subtotal = $row['quantite'] * $row['prix'];
                            $total += $subtotal;
                            ?>
                            <tr>
                                <td><img width="80px" src="img/<?=$row['img']?>"></td>
                                <td><?php echo $row['nom']; ?></td>
                                <td><?php echo $row['quantite']; ?></td>
                                <td><?php echo $row['prix']; ?>€</td>
                                <td>
                                    <a href="suppanier.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-danger">
                                        annuler cet article
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td><h3>Total : </h3></td>
                            <td class=""><h3><strong><?php echo $total; ?>€</strong></h3></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td>   </td>
                            <td>
                                <a href="commandes.php" type="button" class="btn btn-default">
                                    <span class=""></span> continuer la commande
                                </a>
                            </td>
                            <td>
                                <?php
                                // Vérification si le formulaire a été soumis
                                if (isset($_POST['payer_commande'])) {
                                    // Votre code pour traiter le paiement de la commande
                                    // Vérification du crédit de l'utilisateur
                                    $sql_credit = "SELECT credit FROM user WHERE id = '$user'";
                                    $sql_insertcommande = "INSERT INTO commande (utilisateur, img, nom_produit, quantite, prix, heure) VALUES ('$user', ?, ?, ?, ?, NOW())";
                                    $result_credit = mysqli_query($con, $sql_credit);
                                    $row_credit = mysqli_fetch_assoc($result_credit);
                                    $credit = $row_credit['credit'];

                                    if ($credit >= $total_quantite) {
                                        // Suppression des lignes du panier de l'utilisateur connecté
                                        $sql_delete = "DELETE FROM panier WHERE id_utilisateur = '$user'";
                                        mysqli_query($con, $sql_delete);

                                        // Déduction du crédit dans la table "user"
                                        $new_credit = $credit - $total_quantite;
                                        $sql_update_credit = "UPDATE user SET credit = '$new_credit' WHERE id = '$user'";
                                        mysqli_query($con, $sql_update_credit);

                                        // Insertion des produits de la commande dans la table "commande"
                                        $stmt = mysqli_prepare($con, $sql_insertcommande);
                                        mysqli_stmt_bind_param($stmt, "ssii", $img, $nom_produit, $quantite, $prix);

                                        // Parcourir les produits du panier et les insérer dans la table "commande"
                                        mysqli_data_seek($result, 0); // Remettre le pointeur de résultat au début
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $img = $row['img'];
                                            $nom_produit = $row['nom'];
                                            $quantite = $row['quantite'];
                                            $prix = $row['prix'];
                                            mysqli_stmt_execute($stmt);
                                        }
                                        mysqli_stmt_close($stmt);

                                        echo '<p>Votre commande a été payée.</p>';
                                    } else {
                                        echo '<p>Vous n\'avez pas assez de crédit pour valider cette commande.</p>';
                                    }
                                } else {
                                    // Affichage du bouton pour payer la commande
                                    ?>
                                    <form method="POST" action="">
                                        <button type="submit" name="payer_commande" class="btn btn-success">
                                            Payer la commande<span class=""></span>
                                        </button>
                                    </form>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            } else {
                // Si la table "panier" est vide, afficher un message d'erreur
                echo "Le panier est vide.";
            }
            // Fermeture de la connexion à la base de données
            mysqli_close($con);
            ?>
        </div>
    </div>
</div>
</section>

</body>
</html>
