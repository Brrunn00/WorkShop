<?php
session_start();

//connexion à la base de données
$db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
//verifier la connexion
// Votre code PHP ici
?>

<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dashboard/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="dashboard/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboard/assets/libs/css/style.css">
    <link rel="stylesheet" href="dashboard/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="dashboard/assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="dashboard/assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="dashboard/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="dashboard/assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="dashboard/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/profil.css">
	<link href="assets/css/stock.css" rel="stylesheet">
    
    <title>GESTSTOCK - DASHBOARD</title>
</head>

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

        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">  </h2>
                                <p class="pageheader-text">  </p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">  </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">  </li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Revenu Total</h5>
                                        <div class="metric-value d-inline-block">
                <?php
                $db_username = 'root';
                $db_password = '';
                $db_name     = 'gestionstock_bdd';
                $db_host     = 'localhost';
                $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                       or die('could not connect to database');
            //verifier la connexion

                // Sélectionner toutes les commandes effectuées lors de la dernière heure
                $query = "SELECT SUM(prix * quantite) AS total FROM commande";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $averagePrice = $row['total'];

                // Afficher la moyenne du prix total
                echo '<h1 class="mb-1">' . $averagePrice . '</h1>';
                ?>
            </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa fa-fw fa-arrow-up"></i></span><span>5.86%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="text-muted">Revenu ce jour</h5>
            <div class="metric-value d-inline-block">
                <?php
                $db_username = 'root';
                $db_password = '';
                $db_name     = 'gestionstock_bdd';
                $db_host     = 'localhost';
                $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                       or die('could not connect to database');
            //verifier la connexion

                // Sélectionner toutes les commandes effectuées lors de la dernière heure
                $query = "SELECT SUM(prix * quantite) AS total FROM commande WHERE DATE(heure) = CURDATE()";
                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $averagePrice = $row['total'];
                } else {
                    $averagePrice = 0;

                }
                
                // Afficher la moyenne du prix total
                echo '<h1 class="mb-1">' . $averagePrice . '</h1>';
                ?>
            </div>
            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                <span><i class="fa fa-fw fa-arrow-down"></i></span><span>4.82%</span>
            </div>
        </div>
        <div id="sparkline-revenue2"></div>
    </div>
</div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Problème rencontrés</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">0</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                                            <span>N/A</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue3"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Article le plus vendu</h5>
                                        <div class="metric-value d-inline-block">
                <?php
                $db_username = 'root';
                $db_password = '';
                $db_name     = 'gestionstock_bdd';
                $db_host     = 'localhost';
                $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                       or die('could not connect to database');
            //verifier la connexion

                // Sélectionner toutes les commandes effectuées lors de la dernière heure
               $query = "SELECT nom_produit, COUNT(*) AS occurrences FROM commande GROUP BY nom_produit ORDER BY occurrences DESC LIMIT 1";

                $result = mysqli_query($con, $query);
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
$mostFrequentProduct = $row['nom_produit'];


                } else {
                    $averagePrice = 0;
                }
                
               // Afficher le nom du produit le plus fréquent
echo '<h1 class="mb-1">' . $mostFrequentProduct . '</h1>';
                ?>
            </div>
                                        <div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                                            <span>-2.00%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
    <div class="card">
        <h5 class="card-header">Commandes récentes</h5>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-light">
                        <tr class="border-0">
                            <th class="border-0">#</th>
                            <th class="border-0">Image</th>
                            <th class="border-0">Nom du produit</th>
                            <th class="border-0">Utilisateur</th>
                            <th class="border-0">Quantité</th>
                            <th class="border-0">Prix</th>
                            <th class="border-0">Heure</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       
                        // Vérifier la connexion
                        if ($con->connect_error) {
                            die("Échec de la connexion à la base de données : " . $con->connect_error);
                        }

                        // Récupérer les données de la table "commande"
                        $sql = "SELECT * FROM commande";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            $index = 1;
                            while ($row = $result->fetch_assoc()) {
                                $img = $row['img'];
                                $utilisateur = $row['utilisateur'];
                                $nom_produit = $row['nom_produit'];
                                $quantite = $row['quantite'];
                                $prix = $row['prix'];
                                $heure = $row['heure'];
                                
                                echo '<tr>';
                                echo '<td>' . $index . '</td>';
                                echo '<td><img class="img-fluid" width="50" src="img/' . $img . '"></td>';
                                
                                echo '<td>' . $nom_produit . '</td>';
                                echo '<td>' . $utilisateur . '</td>';
                                echo '<td>' . $quantite . '</td>';
                                echo '<td>' . $prix . '</td>';
                                echo '<td>' . $heure . '</td>';
                                echo '</tr>';

                                $index++;
                            }
                        } else {
                            echo '<tr><td colspan="7">Aucune commande trouvée.</td></tr>';
                        }

                        // Fermer la connexion à la base de données
                        $con->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


                        </div>
                        <div class="row">
    <!-- ============================================================== -->
    <!-- product category -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
    <div class="card" width="400px">
        <h5 class="card-header">Catégories de produits les plus achetées</h5>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
    <?php
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');
// Requête SQL pour récupérer les catégories et leurs nombres respectifs
$requete = "SELECT categorie, COUNT(*) as total FROM produit GROUP BY categorie";
$resultat = mysqli_query($con, $requete);

// Tableau pour stocker les catégories et leurs pourcentages
$categories = array();
$pourcentages = array();

// Calculer le total d'éléments
$totalElements = 0;
while ($row = mysqli_fetch_assoc($resultat)) {
    $totalElements += $row['total'];
}

// Calculer les pourcentages
mysqli_data_seek($resultat, 0); // Réinitialiser le pointeur de résultats
while ($row = mysqli_fetch_assoc($resultat)) {
    $categorie = $row['categorie'];
    $pourcentage = ($row['total'] / $totalElements) * 100;

    $categories[] = $categorie;
    $pourcentages[] = $pourcentage;
}
?>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #chart-container {
            width: 400px;
            height: 300px;
            margin: auto;
        }
    </style>

    <div id="chart-container">
        <canvas id="chart"></canvas>
    </div>

    <script>
        // Récupérer les catégories et les pourcentages depuis PHP
        var categories = <?php echo json_encode($categories); ?>;
        var pourcentages = <?php echo json_encode($pourcentages); ?>;

        // Créer le graphique en camembert avec Chart.js
        var ctx = document.getElementById("chart").getContext("2d");
        var chart = new Chart(ctx, {
            type: "pie",
            data: {
                labels: categories,
                datasets: [{
                    data: pourcentages,
                    backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#8B572A", "#C39BD3", "#d62418"] // Couleurs personnalisées
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
</div>



</div>
    </div>
</div>






                            

                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Nombre d'utilisateur</h5>
                                        <div class="metric-value d-inline-block">
                <?php
                $db_username = 'root';
                $db_password = '';
                $db_name     = 'gestionstock_bdd';
                $db_host     = 'localhost';
                $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                       or die('could not connect to database');
            //verifier la connexion

                // Sélectionner toutes les commandes effectuées lors de la dernière heure
              $queryCount = "SELECT COUNT(*) AS totalUsers FROM user";


                $resultCount = mysqli_query($con, $queryCount);
                if(mysqli_num_rows($result) > 0) {
                   $rowCount = mysqli_fetch_assoc($resultCount);
		$totalUsers = $rowCount['totalUsers'];


                } else {
                    $averagePrice = 0;
                }
                
               // Afficher le nom du produit le plus fréquent
echo '<h1 class="mb-1">' . $totalUsers . '</h1>';
                ?>
            </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- new customer  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Nombre de produit</h5>
                                        <div class="metric-value d-inline-block">
                <?php
                $db_username = 'root';
                $db_password = '';
                $db_name     = 'gestionstock_bdd';
                $db_host     = 'localhost';
                $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
                       or die('could not connect to database');
            //verifier la connexion

                // Sélectionner toutes les commandes effectuées lors de la dernière heure
              $queryCount = "SELECT COUNT(*) AS totalProduit FROM produit";


                $resultCount = mysqli_query($con, $queryCount);
                if(mysqli_num_rows($result) > 0) {
                   $rowCount = mysqli_fetch_assoc($resultCount);
		$totalProduit = $rowCount['totalProduit'];


                } else {
                    $averagePrice = 0;
                }
                
               // Afficher le nom du produit le plus fréquent
echo '<h1 class="mb-1">' . $totalProduit . '</h1>';
                ?>
            </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end new customer  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- visitor  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Visitor</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">13000</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end visitor  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Orders</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">1340</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total orders  -->
                            <!-- ============================================================== -->
                        </div>
                        <div class="row">

                            
                        <div class="row">
                            
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- sales traffice source  -->
                                <!-- ============================================================== -->
                               
                            <!-- ============================================================== -->
                            <!-- end sales traffice source  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- sales traffic country source  -->
                            <!-- ============================================================== -->
                            
                            <!-- ============================================================== -->
                            <!-- end sales traffice country source  -->
                            <!-- ============================================================== -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="dashboard/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="dashboard/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="dashboard/assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="dashboard/assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="dashboard/assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="dashboard/assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="dashboard/assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="dashboard/assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="dashboard/assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="dashboard/assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="dashboard/assets/libs/js/dashboard-ecommerce.js"></script>
    




</body>
 
</html>