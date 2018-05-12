<?php
//include ('includes/db_connect.inc.php');
//include ('GestionPanda.php');
//$db=db_connect();

   // echo "Bienvenue sur ton cartable connecté ! </br></br>";
 
    /*echo "Indiquez et modifiez l'état de vos comptes : </br></br>";
    createAccount();
    deleteAccount();
    updateAccount();
    createOp();*/

    include ('db_connect.inc.php');
?> 

<!DOCTYPE <!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Connexion - Mon Cartable Connecté</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="includes/css/index.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
        <script src="includes/js/index.js"></script>
    </head>

    <body>
        <div class="container">

            <header>
                <img src="includes/images/logoV2.svg" id="logo">
                <!--<h1></br>Plateforme de test</h1>-->
            </header>

            <!--<div class="navigation">
                <article id="testDebit">
                    <h2>Bande passante</h2>
                </article>
                <article id="testMiroir">
                    <h2>Miroir</h2>
                </article>
                <article id="testVideo">
                    <h2>Vidéo</h2>
                </article>
            </div>-->

            <div class="bandeau-login">
            <div class="chat-login">
            <?php 
                function formFunc() 
                {
                    if(isset($_POST['submitForm']))
                    {
                        $db = db_connect();
                        $req = $db->prepare("SELECT * FROM users WHERE mail = :email");
                        $req->execute(array("email" => $_POST['email']));
                        
                        while($data = $req->fetch())
                        {
                            if($data['password'] == $_POST['password'])
                            {
                                header("Location: tests.php");
                                exit;
                            }
                        }
                    }
                }
                formFunc();
            ?>
                 <form method="POST" action="index.php">
                        <input type="email" name="email" placeHolder="Votre e-mail"/>
                        <input type="password" name="password" placeHolder="Votre mot de passe"/> <br>
                        <input id="sub" type="submit" name="submitForm" value="Valider">
                 </form>
                </div>
            </div>

            <footer>
                Copyright - <a href="http://www.moncartableconnecte.fr/" target ="_blank">Mon cartable connecté</a>
            </footer>
        </div>
    </body>

</html>