<!DOCTYPE html>
<html>
    <head>
		<title>Mon cartable connecté</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./public/css/css.css">
    </head>

    <body>
		<header>
			<nav class="navbar navbar-default">
				<div class="row">
					<div class="col-md-4 col-md-offset-4">
						<img src="./public/images/logoV2.svg" />
					</div>
				</div>
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
					</div>
					
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">Accueil<span class="sr-only"></span></a></li>
							<li><a href="#">Outils</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
        <div class="container">
			<div class="container-inner">
				<div class="row">
					<div class="col-md-12">
						<div id="connectionTest" class="carousel slide" data-ride="carousel" data-interval="false">
							<!-- Wrapper for slides -->
							<div class="carousel-inner">
								<div class="item active">
									<p>
										<?php
											echo "Bonjour ! Avant de commencer les tests, ta mission si tu l’acceptes est de demander à tes parents de vérifier quelques points : </br></br>

													Vérifier que votre box est connectée.</br></br>
													Éteindre votre décodeur TV.</br></br>
													Vérifier que votre téléphone par internet est bien raccroché.</br></br>
													Basculer vers un raccordement Ethernet si votre ordinateur est connecté en wifi. En effet, le débit d'une connexion wifi peut être influencé par des éléments perturbateurs.</br></br>
													Fermer toutes les applications actives de votre ordinateur.</br></br>
													Désactiver provisoirement vos éventuels logiciels de sécurité (Anti-Virus Firewall, Contrôle Parental…).</br></br>
													C’est fait ? Alors c’est parti ! ";
										?>
									</p>
									<button class="next">Commencer</button>
								</div>

								<div class="item" id="testDebit">
									<div class="titre-debit">
										<?php
											echo "<h3>1</h3></br>";
											echo "<h3>Test de la bande passante </h3></br></br>";                    
										?>
									</div>
									<div class="start-debit">
										<?php
											echo "<h3>Appuie sur le bouton</h3>"
										?>
										<div class="astuceDebit">
										<!--<img src="includes/images/smiley-vert.png" class="smiley" id="smiley-vert-debit">
										<img src="includes/images/smiley-jaune.jpeg" class="smiley" id="smiley-jaune-debit">
										<img src="includes/images/smiley-rouge.jpeg" class="smiley" id="smiley-rouge-debit">
										<img src="includes/images/go.png" class="go">-->
											<?php
												echo '<img src="includes/images/astuces.png" id="astuces">';
												echo "Résultat : Le débit de connexion est trop lent.</br></br>";
												echo "Astuces 1 : Eloigne le modem des sources de chaleur comme les radiateurs et dépoussière-le.                                            Place-le modem près des équipements informatiques.</br></br>";
												echo "Astuces 2 : Assure toi que les câbles ne soient ni tordus ni abîmés.</br></br>";
											?>
										</div>
									</div>
									<button class="next">Continuer</button>
								</div>

								<div class="item" id="testMiroir">
									<div class="titre-miroir">
										<?php
											echo "<h3>2</h3></br>";
											echo "<h3>Test vidéo en miroir </h3></br></br>";
											echo "Vois-tu ton image apparaître sur l'écran? </br></br>";
										?>
									</div>
									<div class="start-miroir">
										<?php
											echo "<h3>Appuie sur le bouton</h3>"
										?>
											<!--<img src="includes/images/smiley-vert.png" class="smiley" id="smiley-vert-miroir">
											<img src="includes/images/smiley-jaune.jpeg" class="smiley" id="smiley-jaune-miroir">
											<img src="includes/images/smiley-rouge.jpeg" class="smiley" id="smiley-rouge-miroir">
											<img src="includes/images/go.png" class="go"> -->  
									</div>
									<button class="next">Continuer</button>
								</div>

								<div class="item" id="testVideo">
									<div class="titre-video">
										<?php
											echo "<h3>3</h3></br>";
											echo "<h3>Test vidéo avec ta classe !</h3> </br></br>"
										?>
									</div>
									<div class="start-debit">
										<?php
											echo "<h3>Appuie sur le bouton</h3>"
										?>
									<!--<img src="includes/images/smiley-vert.png" class="smiley" id="smiley-vert-visio">
									<img src="includes/images/smiley-jaune.jpeg" class="smiley" id="smiley-jaune-visio">
									<img src="includes/images/smiley-rouge.jpeg" class="smiley" id="smiley-rouge-visio">
									<img src="includes/images/go.png" class="go">-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>

		<script src="./vendor/jquery/jquery-3.3.1.min.js"></script>
		<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="./public/js/script.js"></script>

    </body>

</html>