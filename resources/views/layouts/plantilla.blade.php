<!DOCTYPE html>
<html lang="es">
<head>
  <title>Parc Atraccions Univeylandia</title>
  <link rel="icon" href="/img/icon.png" type="image/gif">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css">
  <style>
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
</head>
<body>
    @include("layouts.menu1")
    @yield("menu1")
    @include("layouts.menu2")
    @yield("menu2")
    @yield("body")
    @include("layouts.footer")
    @yield("footer")

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <!--Cookie banner-->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>

	<script>
		window.addEventListener("load", function () {
			window.cookieconsent.initialise({
				"palette": {
					"popup": {
						"background": "#237afc"
					},
					"button": {
						"background": "#fff",
						"text": "#237afc"
					}
				},
				"theme": "classic",
				"position": "bottom-right",
				"content": {
					"message": "Aquesta pàgina web utilitza cookies per millorar l'experiència d'usuari.",
					"dismiss": "D'acord!",
					"link": "Més info",
					"href": "#"
				}
			})
		});
	</script>

  <script>
    $(function() {
        $('.dropdown-toggle').click(function() {
            $(this).next('.dropdown-menu').fadeToggle(300);
        });
    });
  </script>
</body>
</html>
