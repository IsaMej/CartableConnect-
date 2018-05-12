<!DOCTYPE <!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tests - Mon Cartable Connecté</title>
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

            <div class="navigation">
                <article id="testDebit">
                    <h2>Bande passante</h2>
                </article>
                <article id="testMiroir">
                    <h2>Miroir</h2>
                </article>
                <article id="testVideo">
                    <h2>Vidéo</h2>
                </article>
            </div>

        
        <div class="container-tests">
             <div class="bandeau-debit">
                <?php
                    echo "Test de la bande passante </br></br>";
                    echo "Résultat : Le débit de connexion est trop lent.<br/>";
                    echo "Astuces 1 : Eloigne le modem des sources de chaleur comme les radiateurs et dépoussière-le.
                                        Place-le modem près des équipements informatiques.</br></br>";
                ?>
            </div>
                    
            <div class="bandeau-miroir">
                <?php
                    echo "Test vidéo en miroir.</br></br>";
                    echo "Vois-tu ton image appraître en double sur l'écran? </br></br>";
                ?>
            </div>

            <div class="bandeau-video">
                <?php
                    echo "Test vidéo avec ta classe ! </br></br>"
                ?>
            </div>
        </div>


            <footer>
                Copyright - <a href="http://www.moncartableconnecte.fr/" target ="_blank">Mon cartable connecté</a>
            </footer>
        </div>
    </body>

</html>