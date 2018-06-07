<?php
    include ('includes/php/testmiroir.php');
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Tests - Mon Cartable Connecté</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="includes/css/tests.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
        <script src="includes/js/index.js"></script>
    </head>

    <body>
        <a name="haut" id="haut"></a>  
        <div><a id="cRetour" class="cInvisible" href="#haut"></a></div>
            
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            window.onscroll = function(ev) {
                document.getElementById("cRetour").className = (window.pageYOffset > 100) ? "cVisible" : "cInvisible";
            };
            });
        </script>

        <script>
            // javascript/defilement_doux
            document.addEventListener('DOMContentLoaded', function() 
            {
                var aLiens = document.querySelectorAll('a[href*="#"]');
                for(var i=0, len = aLiens.length; i<len; i++) 
                {
                    aLiens[i].onclick = function () {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) 
                    {
                        var target = this.getAttribute("href").slice(1);
                        if (target.length) 
                        {
                            scrollTo(document.getElementById(target).offsetTop, 1000);
                            return false;
                        }
                    }
                }
            }
        
            function scrollTo(element, duration) 
            {
                var e = document.documentElement;
                if(e.scrollTop===0)
                {
                    var t = e.scrollTop;
                    ++e.scrollTop;
                    e = t+1===e.scrollTop--?e:document.body;
                }
                scrollToC(e, e.scrollTop, element, duration);
            }
                
            function scrollToC(element, from, to, duration) 
            {
                if (duration < 0) return;
                if(typeof from === "object")from=from.offsetTop;
                if(typeof to === "object")to=to.offsetTop;
                scrollToX(element, from, to, 0, 1/duration, 20, easeOutCuaic);
            }
                
            function scrollToX(element, x1, x2, t, v, step, operacion) 
            {
                if (t < 0 || t > 1 || v <= 0) return;
                element.scrollTop = x1 - (x1-x2)*operacion(t);
                t += v * step;
                setTimeout(function() 
                {
                    scrollToX(element, x1, x2, t, v, step, operacion);
                }, step);
            }
                
            function easeOutCuaic(t)
            {
                t--;
                return t*t*t+1;
            }
        </script>

        <div class="container">
                <header>
                    <img src="includes/images/logoV2.svg" id="logo">
                </header>

                <div class="intro">
                    <?php
                        echo "Fais les tests et vérifie que tu peux bien utiliser la tablette de l'endroit où tu es !";
                    ?>
                </div>

                <div class="navigation">
                    <div class="nav">
                        <a href="#testDebit"><button class="buttonNav" type="button">Bande passante</button></a>
                        <div class="miniBlock"></div>
                    </div>
                    <div class="nav">
                        <a href="#testMiroir"><button class="buttonNav" type="button">Miroir</button></a>
                        <div class="miniBlock"></div>
                    </div>
                    <div class="nav">
                        <a href="#testVideo"><button class="buttonNav" type="button">Vidéo</button></a>
                        <div class="miniBlock"></div>
                    </div>
                </div>
            
            <div class="container-tests">
                <div class="bandeau-debit" id="testDebit">
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
                        <img src="includes/images/smiley-vert.png" class="smiley" id="smiley-vert-debit">
                        <img src="includes/images/smiley-jaune.jpeg" class="smiley" id="smiley-jaune-debit">
                        <img src="includes/images/smiley-rouge.jpeg" class="smiley" id="smiley-rouge-debit">
                        <img src="includes/images/go.png" class="go">
                            <?php
                                echo '<img src="includes/images/astuces.png" id="astuces">';
                                echo "Résultat : Le débit de connexion est trop lent.</br></br>";
                                echo "Astuces 1 : Eloigne le modem des sources de chaleur comme les radiateurs et dépoussière-le.                                            Place-le modem près des équipements informatiques.</br></br>";
                                echo "Astuces 2 : Assure toi que les câbles ne soient ni tordus ni abîmés.</br></br>";
                            ?>
                        </div>
                    </div>
                </div>
                        
                <div class="bandeau-miroir" id="testMiroir">
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
                    <img src="includes/images/smiley-vert.png" class="smiley" id="smiley-vert-miroir">
                    <img src="includes/images/smiley-jaune.jpeg" class="smiley" id="smiley-jaune-miroir">
                    <img src="includes/images/smiley-rouge.jpeg" class="smiley" id="smiley-rouge-miroir">
                    <img src="includes/images/go.png" class="go">   
                    </div>
                    <div>
                            <script type="text/javascript" src="includes/js/webcam.min.js"></script>
                            <div id="my_camera"></div>
                            <script language="JavaScript">
                            Webcam.set({
                                width: 320,
                                height: 240,
                                image_format: 'jpeg',
                                jpeg_quality: 90
                            });
                            Webcam.attach( '#my_camera' );
                            </script>
                    </div>
                </div>

                <div class="bandeau-video" id="testVideo">
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
                    <img src="includes/images/smiley-vert.png" class="smiley" id="smiley-vert-visio">
                    <img src="includes/images/smiley-jaune.jpeg" class="smiley" id="smiley-jaune-visio">
                    <img src="includes/images/smiley-rouge.jpeg" class="smiley" id="smiley-rouge-visio">
                    <img src="includes/images/go.png" class="go">
                    </div>
                </div>
            </div>

            <footer>
                Copyright - <a href="http://www.moncartableconnecte.fr/" target ="_blank">Mon cartable connecté</a>
            </footer>
        </div>

        <div class="loader">
        
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript">
            $(window).load(function() 
            {
                $(".loader").fadeOut("1000");
            })
        </script>
    </body>

</html>