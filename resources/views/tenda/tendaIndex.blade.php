@extends("layouts.plantilla")

@section("menu1")
@endsection
@section("menu2")
@endsection
@section("content")
<!-- NOTICIES -->
<div class="container" style="margin-top: 80px; margin-bottom: 80px; ">
  <div class="row">
      <div class="card" style="width: 20rem;">
        <img src="/img/rodeo.jpg " class="card-img-top" alt="..." style="height: 300px">
      <div class="card-body">
        <a href="{{URL::route('tendaFotos')}}" class="btn btn-primary" style="margin-left: 50px">Compra la teva foto</a>
      </div>
  </div>
  <div class="card" style="width: 20rem; margin-left: 20px">
      <img src="/img/tendaRoba.jpg " class="card-img-top" alt="..." style="height: 300px">
      <div class="card-body">
      <a href="#" class="btn btn-primary" style="margin-left: 20px">Compra Roba Univeylandia</a>
    </div>
  </div>
  <div class="card" style="width: 20rem; margin-left: 20px">
      <img src="/img/Merchandising.jpg" class="card-img-top" alt="..." style="height: 300px">
    <div class="card-body">
      <a href="#" class="btn btn-primary" style="margin-right: 90px">Compra Merchandising Univeylandia</a>
    </div>
  </div>
  </div>
</div>
@endsection
@section("footer")
@endsection
