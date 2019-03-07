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
      <h3 class="font-weight-bold text-center text-uppercase" >Promocions</h3>
    </div>
  </div>
  <div class ="row">
    <div class="col-sm-6">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge promocio">
      </a>
    </div>
    <div class="col-sm-6">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge promocio">
      </a>
    </div>
  </div>
  <br>
  <div class ="row">
    <div class="col-sm-12">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge promocio">
      </a>
    </div>
  </div>
  <br>
  <div class ="row">
    <div class="col-sm-3">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge promocio">
      </a>
    </div>
    <div class="col-sm-3">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge promocio">
      </a>
    </div>
    <div class="col-sm-3">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge promocio">
      </a>
    </div>
    <div class="col-sm-3">
      <a href="{{ url('/promocions/promocio_x')}}">
        <img src="/img/promocions/promocio1.jpg" class="img-fluid" alt="imatge promocio">
      </a>
    </div>
  </div>
</div>
<br>
@endsection
@section("footer")
@endsection
