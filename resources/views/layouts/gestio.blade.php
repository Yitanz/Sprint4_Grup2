<!DOCTYPE html>
<html lang="es">
<head>
  <title>Parc Atraccions Univeylandia</title>
  <link rel="icon" href="/img/icon.png" type="image/gif">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href=" {{ asset('css/styleGestio.css') }}" type="text/css">
  <style>
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
</head>
<body>
    @include("layouts.navbarIntranet")
    @yield("navbarIntranet")
    @include("layouts.menuIntranet")
    @yield("menuIntranet")
    @yield("body")

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'descripcio_atraccio' );
  </script>

  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>
</body>
</html>
