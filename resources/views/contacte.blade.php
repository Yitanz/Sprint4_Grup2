@extends("layouts.plantilla")

@section("menu1")
@endsection
@section("menu2")
@endsection
@section("body")
<!-- CONTACTE -->
<div class="container jumbotron mt-3">
  <div class="row">
      <div class="col-sm-12">
        <h3 class="font-weight-bold text-center text-uppercase">Formulari de contacte</h3>
      </div>
  </div>
  <form class="align-items-center justify-content-center d-flex">
    <div class="col-sm-12">
      <div class="form-group">
        <label>Nom</label>
        <input type="text" class="form-control" id="exampleInputText1" placeholder="Nom" required>
      </div>
      <div class="form-group">
        <label>Primer cognom</label>
        <input type="text" class="form-control" id="exampleInputText1" placeholder="Primer cognom" required>
      </div>
      <div class="form-group">
        <label>Segon cognom</label>
        <input type="text" class="form-control" id="exampleInputText1" placeholder="Segon cognom">
      </div>
      <div class="form-group">
        <label>Número de telèfon</label>
        <input type="number" class="form-control" id="exampleInputText1" placeholder="Número de telèfon" >
      </div>
      <div class="form-group">
        <label>Adreça de correu electrònic</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Escriu el teu email" required>
        <small id="emailHelp" class="form-text text-muted">No compartirem el teu email amb ningú.</small>
      </div>
      <div class="form-group">
        <label>Missatge</label>
        <textarea type="text" class="form-control" id="exampleInputText1" placeholder="Escriu el teu missatge..." required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Envia</button>
    </div>
  </form>
</div>
<!--  FI CONTACTA -->
@endsection

@section("footer")
@endsection