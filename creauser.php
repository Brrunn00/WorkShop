<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifiez si tous les champs sont remplis
    if (
        isset($_POST['identifiant']) && isset($_POST['motdepasse']) &&
        isset($_POST['etat']) && isset($_POST['mail'])
    ) {
        // Récupérez les données du formulaire
        $identifiant = $_POST['identifiant'];
        $motdepasse = $_POST['motdepasse'];
        $etat = $_POST['etat'];
        $mail = $_POST['mail'];
        $poste = $_POST['poste'];

        // Effectuez des validations et des filtrages si nécessaire

        // Générez un "salt" sécurisé (une chaîne aléatoire)
        $salt = generateSalt(); // Vous devez implémenter generateSalt()

        // Hacher le mot de passe avec crypt()
        $hashedPassword = md5($motdepasse);

        // Connexion à la base de données
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $dbname = 'gestionstock_bdd';

        $conn = mysqli_connect($host, $user, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Insertion de l'utilisateur dans la base de données avec le mot de passe haché
        $query = "INSERT INTO user (id, mdp, etat, mail, poste) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('ssssd', $identifiant, $hashedPassword, $etat, $mail, $poste);
            $stmt->execute();

            // Redirection vers une page de confirmation ou une page de connexion
            header('Location: voiruser.php');
            exit;
        } else {
            die("Prepared statement error: " . $conn->error);
        }
    }
}

// Fonction pour générer un "salt" sécurisé (à implémenter)
function generateSalt() {
    // Générez un "salt" sécurisé ici, par exemple, avec random_bytes()
    // Assurez-vous d'utiliser un algorithme de hachage approprié dans crypt()
    // Retournez le "salt" généré
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
        <form action="creauser.php" method="post">

          <label for="identifiant"><h6>Identifiant</h6></label><br>
          <input type="text" id="identifiant" name="identifiant" placeholder="Identifiant" required><br><br>

          <label for="motdepasse"><h6>Mot de passe</h6></label><br>
          <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required><br><br>
          
          <label for="etat"><h6>Etat</h6>
          <select id="etat" name="etat">
          <option value=""></option>    
          <option value="user" <?php if(isset($_POST['etat']) && $_POST['etat'] == user) { echo "selected"; } ?>>user</option>
          <option value="admin" <?php if(isset($_POST['etat']) && $_POST['etat'] == admin) { echo "selected"; } ?>>admin</option>
              </select>
              <br>
              <br>

              <label for="poste"><h6>grade de l'utilisateur</h6>
          <select id="poste" name="poste">
          <option value=""></option>    
          <option value="1" <?php if(isset($_POST['poste']) && $_POST['poste'] == '1') { echo "selected"; } ?>>gardien</option>
          <option value="2" <?php if(isset($_POST['poste']) && $_POST['poste'] == '2') { echo "selected"; } ?>>siege</option>
          <option value="3" <?php if(isset($_POST['poste']) && $_POST['poste'] == '3') { echo "selected"; } ?>>comex</option>
          <option value="9" <?php if(isset($_POST['poste']) && $_POST['poste'] == '9') { echo "selected"; } ?>>admin</option>
              </select> 

              </label><br>
          <label for="mail"><h6>Adresse mail</h6></label><br>
          <input type="email" id="mail" name="mail" placeholder="Adresse mail" required><br><br>

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