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

<div style="margin: 90px 50px 30px 530px"> </div>

<?php 
	   $host = 'localhost';
		$dbname = 'gestionstock_bdd';
		$username = 'root';
		$password = '';
    
  $dsn = "mysql:host=$host;dbname=$dbname"; 
  ?>
<div class="container py-2">
    <h1>Liste des utilisateurs</h1>
    <br>
    <a href="creauser.php" class="btn btn-primary">Ajouter utilisateur</a>
    
    <br>
    <br>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Profil</th>
                <th>Identifiant</th>
                <th>Mail</th>
                <th>Credit</th>
                <th> Modif_nom </th>
                <th> Modif_mdp </th>
                <th> Modif_credit </th>
                <th> </th>
            </tr>
        </thead>
        <tbody>
        <?php
        require_once 'database.php';
        $categories = $pdo->query('SELECT * FROM user')->fetchAll(PDO::FETCH_ASSOC);
        foreach ($categories as $produit){
            ?>
                <tr>
                <td><img class="img-fluid" width="90" src="img/<?php echo $produit['img'] ?>">
                </td>
                <td><?php echo $produit['id'] ?></td>
                <td><?php echo $produit['mail'] ?></td>
                <td><?php echo $produit['credit'] ?></td>
                <td>
                    <a href="modifier_nom.php?id=<?php echo $produit['id'] ?>" class="btn btn-primary">Modifier Nom</a>
                </td>
                <td>
                    <a class="btn btn-primary" href="modifier_mdp.php?id=<?php echo $produit['id'] ?>">Modifier Mdp</a>
                    </td>
                
                <td>
                    <a class="btn btn-primary" href="modifier_credit.php?id=<?php echo $produit['id'] ?>">Modifier crédit</a>
                    </td>

                <td>
                    <a class="btn btn-danger" href="supuser.php?id=<?php echo $produit['id']; ?>" onclick="return confirm('Voulez vous vraiment supprimer le produit <?php echo $produit->libelle?> ?')">Suppr</a>
                    </td>

                
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>

