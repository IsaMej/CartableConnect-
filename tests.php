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
                document.addEventListener('DOMContentLoaded', function() {
                var aLiens = document.querySelectorAll('a[href*="#"]');
                for(var i=0, len = aLiens.length; i<len; i++) {
                    aLiens[i].onclick = function () {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                        var target = this.getAttribute("href").slice(1);
                        if (target.length) {
                        scrollTo(document.getElementById(target).offsetTop, 1000);
                        return false;
                        }
                    }
                    };
                }
                });
            
                function scrollTo(element, duration) {
                var e = document.documentElement;
                if(e.scrollTop===0){
                    var t = e.scrollTop;
                    ++e.scrollTop;
                    e = t+1===e.scrollTop--?e:document.body;
                }
                scrollToC(e, e.scrollTop, element, duration);
                }
                
                function scrollToC(element, from, to, duration) {
                if (duration < 0) return;
                if(typeof from === "object")from=from.offsetTop;
                if(typeof to === "object")to=to.offsetTop;
                scrollToX(element, from, to, 0, 1/duration, 20, easeOutCuaic);
                }
                
                function scrollToX(element, x1, x2, t, v, step, operacion) {
                if (t < 0 || t > 1 || v <= 0) return;
                element.scrollTop = x1 - (x1-x2)*operacion(t);
                t += v * step;
                setTimeout(function() {
                    scrollToX(element, x1, x2, t, v, step, operacion);
                }, step);
                }
                
                function easeOutCuaic(t){
                t--;
                return t*t*t+1;
                }
                </script>
        <div class="container">

            <header>
                <img src="includes/images/logoV2.svg" id="logo">
                <!--<h1></br>Plateforme de test</h1>-->
            </header>

            <div class="navigation">
                        <button type="button" onclick="window.location.href='../CartableConnecté/testdebit.php'">Bande passante</button>
                        <button type="button" onclick="window.location.href='../CartableConnecté/testmiroir.php'">Miroir</button>
                        <button type="button" onclick="window.location.href='../CartableConnecté/testvisio.htp'">Vidéo</button>
            </div>
            <br />
            <!--<div class="navigation">
                <article id="testDebit">
                    <h2 onclick="selected(1)">Bande passante</h2>
                </article>
                <article id="testMiroir">
                    <h2 onclick="selected(2)">Miroir</h2>
                </article>
                <article id="testVideo">
                    <h2 onclick="selected(3)">Vidéo</h2>
                </article>
            </div>-->

        <div class="intro">
            <div class="text-intro">
            <?php
                echo "Fais les tests et vérifie que tu peux bien utiliser ta tablette de l'endroit où tu es !";
            ?>
            </div>
        </div>
        
        <div class="container-tests">
<<<<<<< HEAD
             <div class="bandeau-debit">
                <div class="titre-debit">
=======
             <div class="bandeau-debit" id="debit">
>>>>>>> 901d515696b55b9598059f4541e61775c14e4708
                <?php
                    echo "<h3>Test de la bande passante </h3></br></br>";
                    
                    echo "Résultat : Le débit de connexion est trop lent.</br></br>";
                    echo '<img src="includes/images/astuces.png" id="astuces">';
                    echo "Astuces 1 : Eloigne le modem des sources de chaleur comme les radiateurs et dépoussière-le.
                                        Place-le modem près des équipements informatiques.</br></br>";
                    echo "Astuces 2 : Assure toi que les câbles ne soient ni tordus ni abîmés.</br></br>";
                ?>
            </div>
            <div class="start-debit">
                <?php
                    echo "<h3>Appuie sur le bouton"
                ?>
            </div>
            </div>
                    
<<<<<<< HEAD
            <div class="bandeau-miroir">
                <div class="titre-miroir">
=======
            <div class="bandeau-miroir" id="miroir">
>>>>>>> 901d515696b55b9598059f4541e61775c14e4708
                <?php
                    echo "<h3>Test vidéo en miroir </3></br></br>";
                    echo "Vois-tu ton image appraître en double sur l'écran? </br></br>";
                ?>
            </div>
            <div class="start-miroir">
                <?php
                    echo "<h3>Appuie sur le bouton"
                ?>
            </div>
            </div>

<<<<<<< HEAD
            <div class="bandeau-video">
                <div class="titre-video">
=======
            <div class="bandeau-video" id="video">
>>>>>>> 901d515696b55b9598059f4541e61775c14e4708
                <?php
                    echo "<h3>Test vidéo avec ta classe !</3> </br></br>"
                ?>
            </div>
            <div class="start-debit">
                <?php
                    echo "<h3>Appuie sur le bouton"
                ?>
            </div>
            </div>

            </div>


            <footer>
                Copyright - <a href="http://www.moncartableconnecte.fr/" target ="_blank">Mon cartable connecté</a>
            </footer>
        </div>

        <div class="loader"></div>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("1000");
        })
        </script>
    </body>

</html>