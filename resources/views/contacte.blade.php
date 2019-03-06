<meta name="csrf-token" content="{{ csrf_token() }}">
@extends("layouts.plantilla")

@section("menu1")
@endsection
@section("menu2")
@endsection
@section("body")
<!-- CONTACTE -->
<div id="app" class="container jumbotron mt-3">
  <div class="row">
      <div class="col-sm-12">
        <h3 class="font-weight-bold text-center text-uppercase">Formulari de contacte</h3>
      </div>
  </div>
  <input-form></input-form>
</div>
<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/vuex"></script>
<script src="{{ ('js/app.js') }}" type="text/javascript"></script>
<!--  FI CONTACTA -->
@endsection

@section("footer")
@endsection
