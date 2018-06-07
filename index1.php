<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Mon cartable connecté</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="./vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./public/css/css.css">
	</head>
	<body>
		<div id="loginForm" class="container">
			<div class="row">
				<div class="col-sm-12 col-md-8 col-md-offset-2">
					<img class="logo" src="./public/images/logoV2.svg" alt="Cartable connecté" />
				</div>
				<div class="col-sm-6 col-md-4 col-md-offset-4">
					<div class="account-wall">
						<form method="POST" class="form-signin">
						<input type="text" class="form-control" name="email" placeholder="Email" required autofocus>
						<input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
						<button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
						<label class="checkbox pull-left">
							<input type="checkbox" value="remember-me">Se souvenir de moi ?
						</label>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			function formFunc() 
			{
				if(isset($_POST['submitForm']))
				{
					$db = db_connect();
					$req = $db->prepare("SELECT * FROM users WHERE email_user = :email");
					$req->execute(array("email" => $_POST['email']));
					while($data = $req->fetch())
					{
						if($data['pwd_user'] == $_POST['password'])
						{
							header("Location: tests1.php");
							exit;
						}
					}
				}
			}
        ?>
		<script src="./vendor/jquery/jquery-3.3.1.min.js"></script>
		<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>