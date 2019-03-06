@extends("layouts.gestio")

@section("navbarIntranet")
@endsection
@section("menuIntranet")
@endsection
@section("body")
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Llistar clients actius</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <button class="btn btn-sm btn-outline-secondary" value="Exportar">
          <span data-feather="save"></span>
          Exportar
        </button>
      </div>
    </div>
  </div>

  <form method="post" style="margin-top=50px;">
    <div class="form-row">
      <div class="col-10">
        <input class="form-control" type="text" name="filtre" placeholder="Filtrar...">
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" class="btn btn-primary" name="buscar" value="Filtrar">
        </div>
      </div>
    </div>
  </form>

  <div class="table-responsive">
    <table class="table table-bordered table-hover table-sm">
      <thead class="thead-light">
        <tr>
          <th scope="col">Nom</th>
          <th scope="col">Primer Cognom</th>
          <th scope="col">Segon Cognom</th>
          <th scope="col">Email</th>
          <th scope="col">Data Naixement</th>
          <th scope="col">Adreça</th>
          <th scope="col">Ciutat</th>
          <th scope="col">Provincia</th>
          <th scope="col">Codi Postal</th>
          <th scope="col">Tipus Document</th>
          <th scope="col">Numero Document</th>
          <th scope="col">Sexe</th>
          <th scope="col">Telèfon</th>
          <th colspan="2">Acció</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($usuaris as $usuari)
        <tr>
          <td>{{$usuari->nom}}</td>
          <td>{{$usuari->cognom1}}</td>
          <td>{{$usuari->cognom2}}</td>
          <td>{{$usuari->email}}</td>
          <td>{{$usuari->data_naixement}}</td>
          <td>{{$usuari->adreca}}</td>
          <td>{{$usuari->ciutat}}</td>
          <td>{{$usuari->provincia}}</td>
          <td>{{$usuari->codi_postal}}</td>
          <td>{{$usuari->tipus_document}}</td>
          <td>{{$usuari->numero_document}}</td>
          <td>{{$usuari->sexe}}</td>
          <td>{{$usuari->telefon}}</td>
          <td><a href="{{route('clients.edit', $usuari->id)}}" type="button" class="btn btn-primary">Modificar</a></td>
          <td>
            <form method="post" action="/gestio/clients/{{$usuari->id}}">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger" type="submit" value="Eliminar">Eliminar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</main>
@endsection