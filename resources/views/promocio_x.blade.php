@extends("layouts.plantilla")

@section("menu1")
@endsection
@section("menu2")
@endsection
@section("content")
<!-- PROMOCIONS -->
<div class="container" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
      <h3 class="font-weight-bold text-center text-uppercase" >Promoció Lorem ipsum</h3>
    </div>
  </div>
  <div class ="row">
    <div class="col-sm-12">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge de la promocio">
      </a>
    </div>
  </div>
  <br>
  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  <br><br>
  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
  <br><br>
  <a href="{{ url('/cistella')}}" class="btn btn-primary" >Comprar</a>
</div>
<br>

@endsection
@section("footer")
@endsection
