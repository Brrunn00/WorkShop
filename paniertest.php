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
		

        <li class="external"><a href="#section2">
		<?php
                session_start();
				if($_SESSION['username'] !== ""){
                    $user = $_SESSION['username'];
                    // afficher un message
                    echo "$user";
                }
            ?>
		</a>
          <ul class="sub-menu">
          <li><a href="page_profil.php">Profil</a></li>
            <li><a href="panier.php">Panier</a></li>
            <li><a href="login.php" rel="sponsored" class="external">Deconnexion</a></li>
          </ul>
        </li>
      </ul>
    </nav>
	
	
  </header>
<section class="container">

<div style="margin: 130px 50px 30px 530px"> </div>
<h2> Panier</h2>
<br>
<?php 
// Connexion à la base de données
$db_username = 'root';
    $db_password = '';
    $db_name     = 'gestionstock_bdd';
    $db_host     = 'localhost';
    $con = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');

// Récupération des données de la table "panier"
$sql = "SELECT * FROM panier";
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
                
                <tr>
                <?php
			// Affichage des données de la table "panier" dans un tableau HTML
            $total = 0;
			while($row = mysqli_fetch_assoc($result)) {
                $subtotal = $row['quantite'] * $row['prix'];
            $total += $subtotal;
			?>
                <td><img width="80px" src="img/<?=$row['img']?>"></td>
				<td><?php echo $row['nom']; ?></td>
				<td><?php echo $row['quantite']; ?></td>
                <td><?php echo  $row['prix']; ?>€</td>
                
                <td>
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button></td>
                        
                    </tr>
                    
                    <?php } ?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong><?php echo $total; ?>€</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <button href="commande.php" type="button" class="btn btn-default">
                            <span  class="glyphicon glyphicon-shopping-cart"></span> continuer la commande
                        </button></td>
                        <td>
                        <button type="button" class="btn btn-success">
                            Payer la commande <span class="glyphicon glyphicon-play"></span>
                        </button></td>
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
</body>
</html>

