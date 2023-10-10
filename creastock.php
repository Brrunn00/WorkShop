<?php
session_start();

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si tous les champs sont remplis
    if (
        isset($_POST['nom']) && isset($_POST['quantite']) &&
        isset($_POST['prix']) && isset($_POST['img'])
    ) {
        // Récupérez les données du formulaire
        $nom = $_POST['nom'];
        $quantite = $_POST['quantite'];
        $prix = $_POST['prix'];
        $img = $_POST['img'];

        // Connexion à la base de données
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'gestionstock_bdd';

        $conn = mysqli_connect($host, $user, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Obtenez l'ID le plus élevé existant dans la table produit
        $query = "SELECT MAX(id) AS max_id FROM produit";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $nextId = $row['max_id'] + 1;

        // Insertion de l'utilisateur dans la base de données
        $query = "INSERT INTO produit (id, nom, quantite, prix, img) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('isdds', $nextId, $nom, $quantite, $prix, $img);
            $stmt->execute();

            // Redirection vers une page de confirmation ou une page de connexion
            header('Location: voirstock.php');
            exit;
        } else {
            die("Prepared statement error: " . $conn->error);
        }
    }
}
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
		

        <li class="external"><a href="#section2">
		<?php
					if($_SESSION['username'] !== ""){
                    $user = $_SESSION['username'];
                    // afficher un message
                    echo "$user";
                }
            ?>
		</a>
          <ul class="sub-menu">
            <li><a href="page_profil.php">Profil</a></li>
            <li><a href="#section3">Documents</a></li>
            <li><a href="panier.php">Panier</a></li>
            <li><a href="login.php" rel="sponsored" class="external">Deconnexion</a></li>
          </ul>
        </li>
      </ul>
    </nav>
	
	
  </header>

	<!-- ***** Main Banner Area Start ***** -->
	<section class="section main-banner" id="top" data-section="section1">
  <video autoplay muted loop id="bg-video">
    <source src="assets/images/course-video.mp4" type="video/mp4" />
  </video>

  <div class="video-overlay header-text">
    <div class="caption">
      <h2><em>NOUVEL </em>UTILISATEUR</h2>
      <div class="wrapper">
        <form action="creastock.php" method="post">

          <label for="nom"><h6>NOM DU PRODUIT</h6>
          <input type="text" id="nom" name="nom" placeholder="nom" required><br><br> 
		</label><br>


          <label for="quantite"><h6>QUANTITE DU PRODUIT</h6></label><br>
          <input type="text" id="quantite" name="quantite" placeholder="quantite" required><br><br>

		  <label for="prix"><h6>PRIX DU PRODUIT</h6></label><br>
          <input type="text" id="prix" name="prix" placeholder="prix" required><br><br>

          <label for="img"><h6>IMAGE DU PRODUIT</h6></label><br>
		  <center>
		  <input type="file" id="img" name="img" accept="image/png, image/jpeg">
			</center><br><br>


          <input type="submit" value="Créer">
        </form>
      </div>
    </div>
  </div>
</section>

	<!-- ***** Main Banner Area End ***** -->


 
	<!-- Scripts -->
	<!-- Bootstrap core JavaScript -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="vendor/bootstrap/js/log.js.js"></script>
		<script src="assets/js/isotope.min.js"></script>
		<script src="assets/js/owl-carousel.js"></script>
		<script src="assets/js/lightbox.js"></script>
		<script src="assets/js/tabs.js"></script>
		<script src="assets/js/video.js"></script>
		<script src="assets/js/slick-slider.js"></script>
		<script src="assets/js/custom.js"></script>
	<script src="assets/js/log.js"></script>
		<script>
				//according to loftblog tut


				var showSection = function showSection(section, isAnimate) {
					var
					direction = section.replace(/#/, ''),
					reqSection = $('.section').filter('[data-section="' + direction + '"]'),
					reqSectionPos = reqSection.offset().top - 0;

					if (isAnimate) {
						$('body, html').animate({
							scrollTop: reqSectionPos },
						800);
					} else {
						$('body, html').scrollTop(reqSectionPos);
					}

				};

				var checkSection = function checkSection() {
					$('.section').each(function () {
						var
						$this = $(this),
						topEdge = $this.offset().top - 80,
						bottomEdge = topEdge + $this.height(),
						wScroll = $(window).scrollTop();
						if (topEdge < wScroll && bottomEdge > wScroll) {
							var
							currentId = $this.data('section'),
							reqLink = $('a').filter('[href*=\\#' + currentId + ']');
							reqLink.closest('li').addClass('active').
							siblings().removeClass('active');
						}
					});
				};

				$('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
					if($(e.target).hasClass('external')) {
						return;
					}
					e.preventDefault();
					$('#menu').removeClass('active');
					showSection($(this).attr('href'), true);
				});

				$(window).scroll(function () {
					checkSection();
				});
		
		</script>
</body>
</html>