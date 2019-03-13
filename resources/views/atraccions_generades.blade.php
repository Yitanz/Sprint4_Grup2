@extends("layouts.plantilla")
<style>
.full-width-image {
   width: 100vw;
   position: relative;
}

.full-width-image img {
  width: 100%;
  height: 70%;
  position: relative;
    display: inline-block;
    text-align: center;
}

.centrado{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

}

.titol_atraccio{
    text-transform: uppercase;
   color: white;
  text-shadow: 2px 0 0 #000000, -2px 0 0 #000000, 0 2px 0 #000000, 0 -2px 0 #000000, 1px 1px #000000, -1px -1px 0 #000000, 1px -1px 0 #000000, -1px 1px 0 #000000;
}
</style>
@section("menu1")
@endsection
@section("menu2")
@endsection
@section("content")
<!-- foto -->
<div class="full-width-image">
  <img class="img-fluid" src="{{ $atraccions->path }}">
  <div class="centrado">
    <h1 class="titol_atraccio">  {{ $atraccions->nom_atraccio }} </h1>
  </div>
</div>





<div class="container" style="margin-top:30px">
  <div class="row">
      <div class="col-sm-12">

           <div class="card-body d-flex flex-column align-items-start">
             <p class="card-text">{{ $atraccions->descripcio }}</p>
          </div>

<!-- llistar dades atraccio-->
<div class="col-sm-12">
  <table id="t01">
   <tr>
     <th>Firstname</th>
     <th>Lastname</th>
     <th>Age</th>
   </tr>
   <tr>
     <td>Eve</td>
     <td>Jackson</td>
     <td>94</td>
   </tr>
  </table>
</div>

  </div>



</div>
</div>
</div>
</div>

@endsection
@section("footer")
@endsection
