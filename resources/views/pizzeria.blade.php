<!DOCTYPE html>
<html lang="en">

<head>
    <title>Parc Atraccions Univeylandia</title>
    <link rel="icon" href="img/icon.png" type="image/gif">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <style>
        .fakeimg {
      height: 200px;
      background: #aaa;
  }

  #alergens_desplegable {
    font-style: italic;
    display: none;
  }
  </style>
</head>

<body onload="onload(), checkCookie()" onscroll="scroll()">
    <nav class="navbar navbar-expand-sm py-0">
        <div class="collapse navbar-collapse flex-row-reverse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> Idioma </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">ES</a></li>
                        <li><a class="dropdown-item" href="#">CA</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="img/mapa_parc.jpg">Mapa</a>
                </li>
                <li>
                    <a class="nav-link" href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark py-4">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> Parc </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="noticies/noticies_1.php">Noticies</a></li>
                        <li><a class="dropdown-item" href="promocions.php">Promocions</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Atraccions</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> Hotel </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Habitacions</a></li>
                        <li><a class="dropdown-item" href="#">Restaurants</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> Entrades </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="Entrades/parc/entrades1.php">Parc</a></li>
                        <li><a class="dropdown-item" href="Entrades/hoteliparc/entrades2.php">Parc+Hotel</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>


    <!-- PIZZA -->
    <!--
                      EVENTOS HECHOS:
                        ON CLICK , ON DOUBLE CLICK, ON MOUSE OVER, ON MOUSE OUT, RADIO BUTTON CHECKED
                        ON KEY DOWN, COMPROVACIO DEL EMAIL, ON KEY UP, ON LOAD, SCROLL, BLUR, ON FOCUS, ON ABORT  N O   A C A B A D O
                                          -->
    <div class="container jumbotron" style="margin-top:30px">
        <div class="row">
            <div class="col-sm-12">

                <iframe src="banners/univeylados/univeylados.html" height="110" width="1050"></iframe>

                <h3 class="font-weight-bold text-center text-uppercase">PERSONALITZA LA TEVA PIZZA</h3>
                <br>
            </div>
        </div>
        <div class=text-center>
            <script type="text/javascript">
                var ingredients_afegits = new Array();									//variable per emmagatzemar els ingredients que es seleccionen
                var massa = false;																		//boolean per saber i ja hem escollit una massa
                var comptador = 0;                                    //variable per comptar la quantitat de lletres que s'han escrit en el textholder dels sugeriments

                /*Mètode per a sumar els ingredients i el seu preu total*/
                function afegir(preu_pizza, i, j, ingredient_pizza) {
                    if (i == 0 && massa) {																	//comprovem si hem seleccionat una massa
                        alert("Ja has seleccionat una massa");
                    }
                    else if (!ingredients_afegits.includes(ingredient_pizza[i][j])) {
                        if (i == 0) { massa = true; }															//actualitzem el valor del boolean perque i==0 vol dir que hem seleccionat una massa y no podem seleccionar més
                        preu_total = preu_total + preu_pizza[i][j];
                        ingredients_afegits.push(ingredient_pizza[i][j]);
                        canvis(preu_total, i, j);
                    }
                    else {
                        /*Borrem l'ingredient si ja existeix*/
                        for (z = 0; z < ingredients_afegits.length; ++z) {
                            if (ingredients_afegits[z].localeCompare(ingredient_pizza[i][j]) == 0) {
                                ingredients_afegits.splice(z, 1);
                            }
                        }
                        preu_total = preu_total - preu_pizza[i][j];
                        canvis(preu_total, i, j);
                        //alert("Ja has afegit aquest ingredient");
                    }
                }
                /*Mètode per a actualitzar el preu i els ingredients en la pàgina*/
                function canvis(preu, i, j) {
                    var str = document.getElementById("preu").innerHTML;
                    var resultat = "El preu de la teva pizza es: " + Math.round(preu * 100) / 100 + "€";
                    document.getElementById("preu").innerHTML = resultat;

                    var llista_ingredients = "Els ingredients son: " + ingredients_afegits.join(", ");
                    document.getElementById("ingredients").innerHTML = llista_ingredients;

                    ingredients_string = ingredients_afegits.toString();
                }

                /*Mètode per a buidar els ingredients*/
                function buidar() {
                    preu_total = 0;
                    ingredients_afegits = [];

                    document.getElementById("preu").innerHTML = "El preu de la teva pizza es: 0€";

                    document.getElementById("ingredients").innerHTML = "Els ingredients son:";
                }

                /*Mètode utilitzat en mouseover*/
                function mouseover() {
                    document.getElementById("mouseover").innerHTML = " Per eliminar-lo selecciona'l una altra vegada.";
                }
                /*Mètode utilitzat en mouseout*/
                function mouseout() {
                    document.getElementById("mouseout").innerHTML = " O pots restablir els ingredients.";
                }
                /*Mètode utilitzat en keydown*/
                function keydown() {
                    var email = document.getElementById("email").value;
                    document.getElementById("email_confirm").innerHTML = "Confirma que el teu email és: " + email;
                }
                /*Mètode utilitzat en KEYUP*/
                function keyup() {
                    ++comptador;
                    document.getElementById("lletres_sugeriments").innerHTML = comptador + "/500 caracters.";
                }

                /*Mètode utilitzat en onLoad*/
                function onload() {
                    $("#formulario").hide();
                }

                /*Mètode utilitzat en Scroll*/
                var x = 0;
                function scroll() {
                    x += 1;
                    if (x == 80) {
                        alert('Et recomanem la pizza amb massa original, pernil dolç, bacó i mozzarella!');
                    }
                }

                /*Mètode utilitat onBlur, SE ACTIVA CUANDO 'SALES' DEL CAMPO DE TEXTO*/
                function noFoco() {
                    var x = document.getElementById("nom");
                    x.value = x.value.toUpperCase();
                    x.style.background = "white";

                    var y = document.getElementById("cognoms");
                    y.value = y.value.toUpperCase();
                    y.style.background = "white";

                }

                /*Mètode utilitzat en l'event onFocus*/
                function foco(x) {
                    x.style.background = "yellow";
                }

                /*Mètode utilitzar en l'event onAbort*/
                function abortar() {
                    alert("Algunes imatges no s'han pogut carregar completament.");
                }
                var preu_total = 0;
                /*Array amb els ingredients*/
                var ingredient_massa = new Array('Massa fina', 'Massa grosa', 'Massa original', 'Amb formatge');
                var ingredient_carn = new Array('Carn picada', 'Bacó', 'Pernil salat', 'Pernil dolç');
                var ingredient_formatge = new Array('Cheddar', 'Roquefort', 'De cabra', 'Mozzarella');
                var ingredient_vegetals = new Array('Cogombret', 'Ceba', 'Pebrot roig', 'Pebrot Verd');
                var ingredient_pizza = new Array(ingredient_massa, ingredient_carn, ingredient_formatge, ingredient_vegetals);

                /*Array amb les imatges*/
                var img_carn = new Array('carn.jpg', 'baco.jpeg', 'pernil.jpg', 'pernildolc.jpeg');
                var img_masa = new Array('fina.jpg', 'gorda.jpeg', 'normal.jpg', 'queso.jpg');
                var img_formatge = new Array('cheddar.jpg', 'roquefort.jpeg', 'cabra.jpeg', 'mozzarella.jpg');
                var img_vegetals = new Array('cogombret.JPG', 'ceba.png', 'pebrotr.jpg', 'pebrotv.jpg');
                var img_pizza = new Array(img_masa, img_carn, img_formatge, img_vegetals);

                /*Array amb el preu dels ingredients*/
                var preu_masa = new Array(4, 5, 4, 7);
                var preu_carn = new Array(2, 0.8, 1, 1);
                var preu_formatge = new Array(0.8, 1.2, 1.2, 1);
                var preu_vegetals = new Array(0.5, 0.75, 0.65, 0.65);
                var preu_pizza = new Array(preu_masa, preu_carn, preu_formatge, preu_vegetals);

                /*Bucle per a imprimir els botons amb els ingredients*/
                for (i = 0; i < ingredient_pizza.length; i++) {
                    for (j = 0; j < ingredient_pizza[i].length; j++) {
                        document.write("<a href=\"img/" + img_pizza[i][j] + "\" data-fancybox data-caption=\"Pizzeria Univeylandia\">");
                        document.write("<img src=\"img/" + img_pizza[i][j] + "\" width=\"100\" height=\"60\"> ");
                        document.write("</a>");
                        document.write("<button class=\"btn btn-primary\" style=\"margin-right:30px;\" name=" + preu_pizza[i][j] +
                            " ondblclick=\"afegir(preu_pizza," + i + "," + j + ", ingredient_pizza)\">" + ingredient_pizza[i][j] + "</button> ");
                    }
                    document.write("<br> <br>");
                }

                document.write("</div>");
                document.write("<p id=\"preu\">El preu de la teva pizza es: 0€</p>");
                document.write("<p id=\"ingredients\">Els ingredients son:</p>");

                document.write("<button onclick=\"buidar()\" class=\"btn btn-primary\">Buida els ingredients</button>   ");
                document.write("<button id=\"suggeriments\" class=\"btn btn-primary\">Envia'ns els teus suggeriments</button>   ");
                document.write("<button onClick = \"location.reload()\" class=\"btn btn-primary\">Envia</button>   ");

                document.write("<br><a onmouseover=\"mouseover()\" onmouseout=\"mouseout()\" class=\"small\">Només pots afegir un ingredient una vegada.</a>");
                document.write("<a class=\"small\" id=\"mouseover\"></a>");
                document.write("<a class=\"small\" id=\"mouseout\"></a>");
                document.write("<a onkeydown=\"keydown()\" id=\"keydown\"></a>");

            </script>

            <div id="formulario" style="margin-top:30px; margin-left: 200px; margin-right: 200px;">

                <form>
                    <fieldset>
                        <legend>Suggeriments</legend>

                        <label for="nombre">Nom</label>
                        <input required type="text" size="15" id="nom" onblur="noFoco()" onfocus="foco(this)">

                        <label for="apellidos">Cognoms</label>
                        <input type="text" size="36" id="cognoms" onblur="noFoco()" onfocus="foco(this)">

                        <br>
                        <label for="email">e-Mail</label>
                        <input onkeydown="keydown()" required type="text" id="email" size="60" onfocus="foco(this)">
                        <br>
                        <a id="email_confirm" class="small"></a>
                        <br>
                        <a id="email_error" class="small" style="color:red;"></a>

                        <br>
                        <br>
                        <input onkeyup="keyup()" required type="textarea" size="65" id="sugeriments" placeholder="Escriu els teus sugeriments"
                            maxlength="500" />
                        <br>
                        <a id="lletres_sugeriments" class="small"></a>

                        <br>
                        <br>
                        <label for="alergens">Alergens</label>
                        <br>
                        <div style="margin-left: 15px;">
                            <input type="checkbox" name="alergen1" value="fruts secs">Soc alergic a alguns fruts secs<br>
                            <input type="checkbox" name="alergen2" value="lactosa">Soc alergic a la lactosa<br>
                            <input type="checkbox" name="alergen3" value="gluten">Soc alergic al gluten<br>
                        </div>

                        <br>
                        <br>
                        <label for="alergens">Estic conforme en que s'emmagatzeme aquesta informació</label>
                        <br>
                        <div style="margin-left: 15px;">
                            <input type="radio" name="informacio" value="si" checked>Sí<br>
                            <input type="radio" name="informacio" value="no">No<br>
                        </div>

                        <br>
                        <input onclick="comprovar_informacio()" class="btn btn-primary" type="submit" value="Envia" />
                    </fieldset>
                </form>
            </div>
            <br><br>
            <div id="alergens_avis">
                Fes click per a veure els alergens
            </div>

            <button class="btn btn-secondary" id="stop">Parar animació</button>
            <div id="alergens_desplegable">
                Les pizzes no contenen gluten ni lactosa.
                <div id="img_alergens"> <img id="img_alergens2" src='img/alergens.png' width="364" height="180">
                </div>
            </div>
            <!-- FI PIZZA -->

            <!-- SCRIPTS -->
            <script>
                function comprovar_informacio() {
                    /*Si/No*/
                    var elementos = document.getElementsByName("informacio");

                    if (elementos[1].checked) {
                        alert("Has d'acceptar que s'emmagatzeme la informació");
                    }
                    /*email*/
                    var email = document.getElementById("email").value;
                    if (!(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(email))) {
                        document.getElementById("email_error").innerHTML = "Has d'escriure una direcció d'email amb format correcte (john@doe.org)";
                    }
                }

                /* - J Q U E R Y - */
                //hide usado en onload(), fadeIn,
                $(document).ready(function () {
                    $("#suggeriments").click(function () {
                        $("#formulario").fadeIn("slow");
                    });

                    //Slide
                    $("#alergens_avis").click(function () {
                        $("#alergens_desplegable").slideDown(10000);
                    });

                    //Animate
                    $("#img_alergens").click(function () {
                        $("#img_alergens2").animate({ opacity: '0.5' });
                    });

                    //Stop
                    $("#stop").click(function () {
                        $("#alergens_desplegable").stop();
                    });
                });


                /* C O O K I E S */
                function setCookie(cname, cvalue, exdays) {
                    var d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + d.toGMTString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                function getCookie(cname) {
                    var name = cname + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var ca = decodedCookie.split(';');
                    for (var i = 0; i < ca.length; i++) {
                        var c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }

                function checkCookie() {
                    var ingredient = getCookie("cookie_ingredient");
                    if (ingredient != "") {
                        alert("El teu ingredient favorit es " + ingredient);
                    } else {
                        ingredient = prompt("Quin és el teu ingredient favorit:", "");
                        if (ingredient != "" && ingredient != null) {
                            setCookie("cookie_ingredient", ingredient, 30);
                        }
                    }
                }

            </script>


            <div class="jumbotron text-center" width="100%" style="margin-bottom:0">
                <div class="row">

                    <div class="col-sm-2">
                        <h6>Univeylandia</h6>
                        <ul class="list-inline">
                            <li><a href="#">Sobre nosaltres</a></li>
                            <li><a href="#">Reconeixements</a></li>
                            <li><a href="#">Treballa amb nosaltres</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Contacte</a></li>
                        </ul>
                    </div>

                    <div class="col-sm-2">
                        <h6>Condicions</h6>
                        <ul class="list-inline">
                            <li><a href="#">Condicions generals</a></li>
                            <li><a href="#">Política de privacitat</a></li>
                            <li><a href="#">Normes del Resort</a></li>
                            <li><a href="#">Politica de cookies</a></li>
                            <li><a href="#">MAPA WEB</a></li>
                        </ul>
                    </div>

                    <div class="col-sm-2">
                        <h6>Parc</h6>
                        <ul class="list-inline">
                            <li><a href="#">Atraccions</a></li>
                            <li><a href="#">Hotel</a></li>
                            <li><a href="#">Restaurants</a></li>
                        </ul>
                    </div>

                    <div class="col-sm-3">
                        <h3>Truca'ns</h3>
                        <p>642 18 90 00</p>
                    </div>

                    <div class="col-sm-3">
                        <h3>Segueix-nos</h3>
                        <a href="#">
                            <img class="img_face" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQ5LjY1MiA0OS42NTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5LjY1MiA0OS42NTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjQuODI2LDBDMTEuMTM3LDAsMCwxMS4xMzcsMCwyNC44MjZjMCwxMy42ODgsMTEuMTM3LDI0LjgyNiwyNC44MjYsMjQuODI2YzEzLjY4OCwwLDI0LjgyNi0xMS4xMzgsMjQuODI2LTI0LjgyNiAgICBDNDkuNjUyLDExLjEzNywzOC41MTYsMCwyNC44MjYsMHogTTMxLDI1LjdoLTQuMDM5YzAsNi40NTMsMCwxNC4zOTYsMCwxNC4zOTZoLTUuOTg1YzAsMCwwLTcuODY2LDAtMTQuMzk2aC0yLjg0NXYtNS4wODhoMi44NDUgICAgdi0zLjI5MWMwLTIuMzU3LDEuMTItNi4wNCw2LjA0LTYuMDRsNC40MzUsMC4wMTd2NC45MzljMCwwLTIuNjk1LDAtMy4yMTksMGMtMC41MjQsMC0xLjI2OSwwLjI2Mi0xLjI2OSwxLjM4NnYyLjk5aDQuNTZMMzEsMjUuN3ogICAgIiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" />
                        </a>
                        <a href="#">
                            <img class="img_face" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQ5LjY1MiA0OS42NTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5LjY1MiA0OS42NTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjQuODI2LDBDMTEuMTM3LDAsMCwxMS4xMzcsMCwyNC44MjZjMCwxMy42ODgsMTEuMTM3LDI0LjgyNiwyNC44MjYsMjQuODI2YzEzLjY4OCwwLDI0LjgyNi0xMS4xMzgsMjQuODI2LTI0LjgyNiAgICBDNDkuNjUyLDExLjEzNywzOC41MTYsMCwyNC44MjYsMHogTTM1LjkwMSwxOS4xNDRjMC4wMTEsMC4yNDYsMC4wMTcsMC40OTQsMC4wMTcsMC43NDJjMCw3LjU1MS01Ljc0NiwxNi4yNTUtMTYuMjU5LDE2LjI1NSAgICBjLTMuMjI3LDAtNi4yMzEtMC45NDMtOC43NTktMi41NjVjMC40NDcsMC4wNTMsMC45MDIsMC4wOCwxLjM2MywwLjA4YzIuNjc4LDAsNS4xNDEtMC45MTQsNy4wOTctMi40NDYgICAgYy0yLjUtMC4wNDYtNC42MTEtMS42OTgtNS4zMzgtMy45NjljMC4zNDgsMC4wNjYsMC43MDcsMC4xMDMsMS4wNzQsMC4xMDNjMC41MjEsMCwxLjAyNy0wLjA2OCwxLjUwNi0wLjE5OSAgICBjLTIuNjE0LTAuNTI0LTQuNTgzLTIuODMzLTQuNTgzLTUuNjAzYzAtMC4wMjQsMC0wLjA0OSwwLjAwMS0wLjA3MmMwLjc3LDAuNDI3LDEuNjUxLDAuNjg1LDIuNTg3LDAuNzE0ICAgIGMtMS41MzItMS4wMjMtMi41NDEtMi43NzMtMi41NDEtNC43NTVjMC0xLjA0OCwwLjI4MS0yLjAzLDAuNzczLTIuODc0YzIuODE3LDMuNDU4LDcuMDI5LDUuNzMyLDExLjc3Nyw1Ljk3MiAgICBjLTAuMDk4LTAuNDE5LTAuMTQ3LTAuODU0LTAuMTQ3LTEuMzAzYzAtMy4xNTUsMi41NTgtNS43MTQsNS43MTMtNS43MTRjMS42NDQsMCwzLjEyNywwLjY5NCw0LjE3MSwxLjgwNCAgICBjMS4zMDMtMC4yNTYsMi41MjMtMC43MywzLjYzLTEuMzg3Yy0wLjQzLDEuMzM1LTEuMzMzLDIuNDU0LTIuNTE2LDMuMTYyYzEuMTU3LTAuMTM4LDIuMjYxLTAuNDQ0LDMuMjgyLTAuODk5ICAgIEMzNy45ODcsMTcuMzM0LDM3LjAxOCwxOC4zNDEsMzUuOTAxLDE5LjE0NHoiIGZpbGw9IiMwMDAwMDAiLz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
                        </a>

                        <a href="#">
                            <img class="img_face" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjMycHgiIGhlaWdodD0iMzJweCIgdmlld0JveD0iMCAwIDQ5LjY1MiA0OS42NTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ5LjY1MiA0OS42NTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8Zz4KCQk8Zz4KCQkJPHBhdGggZD0iTTI0LjgyNSwyOS43OTZjMi43MzksMCw0Ljk3Mi0yLjIyOSw0Ljk3Mi00Ljk3YzAtMS4wODItMC4zNTQtMi4wODEtMC45NC0yLjg5N2MtMC45MDMtMS4yNTItMi4zNzEtMi4wNzMtNC4wMjktMi4wNzMgICAgIGMtMS42NTksMC0zLjEyNiwwLjgyLTQuMDMxLDIuMDcyYy0wLjU4OCwwLjgxNi0wLjkzOSwxLjgxNS0wLjk0LDIuODk3QzE5Ljg1NCwyNy41NjYsMjIuMDg1LDI5Ljc5NiwyNC44MjUsMjkuNzk2eiIgZmlsbD0iIzAwMDAwMCIvPgoJCQk8cG9seWdvbiBwb2ludHM9IjM1LjY3OCwxOC43NDYgMzUuNjc4LDE0LjU4IDM1LjY3OCwxMy45NiAzNS4wNTUsMTMuOTYyIDMwLjg5MSwxMy45NzUgMzAuOTA3LDE4Ljc2MiAgICAiIGZpbGw9IiMwMDAwMDAiLz4KCQkJPHBhdGggZD0iTTI0LjgyNiwwQzExLjEzNywwLDAsMTEuMTM3LDAsMjQuODI2YzAsMTMuNjg4LDExLjEzNywyNC44MjYsMjQuODI2LDI0LjgyNmMxMy42ODgsMCwyNC44MjYtMTEuMTM4LDI0LjgyNi0yNC44MjYgICAgIEM0OS42NTIsMTEuMTM3LDM4LjUxNiwwLDI0LjgyNiwweiBNMzguOTQ1LDIxLjkyOXYxMS41NmMwLDMuMDExLTIuNDQ4LDUuNDU4LTUuNDU3LDUuNDU4SDE2LjE2NCAgICAgYy0zLjAxLDAtNS40NTctMi40NDctNS40NTctNS40NTh2LTExLjU2di01Ljc2NGMwLTMuMDEsMi40NDctNS40NTcsNS40NTctNS40NTdoMTcuMzIzYzMuMDEsMCw1LjQ1OCwyLjQ0Nyw1LjQ1OCw1LjQ1N1YyMS45Mjl6IiBmaWxsPSIjMDAwMDAwIi8+CgkJCTxwYXRoIGQ9Ik0zMi41NDksMjQuODI2YzAsNC4yNTctMy40NjQsNy43MjMtNy43MjMsNy43MjNjLTQuMjU5LDAtNy43MjItMy40NjYtNy43MjItNy43MjNjMC0xLjAyNCwwLjIwNC0yLjAwMywwLjU2OC0yLjg5NyAgICAgaC00LjIxNXYxMS41NmMwLDEuNDk0LDEuMjEzLDIuNzA0LDIuNzA2LDIuNzA0aDE3LjMyM2MxLjQ5MSwwLDIuNzA2LTEuMjEsMi43MDYtMi43MDR2LTExLjU2aC00LjIxNyAgICAgQzMyLjM0MiwyMi44MjMsMzIuNTQ5LDIzLjgwMiwzMi41NDksMjQuODI2eiIgZmlsbD0iIzAwMDAwMCIvPgoJCTwvZz4KCTwvZz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
                        </a>
                    </div>

                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.6/jquery.fancybox.min.js"></script>
</body>

</html>