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
    </body>
</html>