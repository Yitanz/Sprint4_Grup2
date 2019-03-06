@extends("layouts.gestio")

@section("navbarIntranet")
@endsection
@section("menuIntranet")
@endsection
@section("body")
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <style>
      .uper {
        margin-top: 40px;
      }
    </style>
    @if(session()->get('success'))
    <div class="uper">
        <div class="alert alert-success">
          {{ session()->get('success') }}
        </div>
    </div>
    @endif
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Administrar Serveis</h1>
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
                        <th>ID</th>
                        <th>Zona</th>
                        <th>Servei</th>
                        <th>Empleat</th>
                        <th colspan="2">Acció</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach($assignacions as $servei_zona)
                    <tr>
                        <td>{{ $servei_zona->id }}</td>
                        <td>{{ $servei_zona->nom_zona }}</td>
                        <td>{{ $servei_zona->nom_servei }}</td>
                        <td>{{ $servei_zona->nom_empleat }}</td>
                        <td><a class="btn btn-primary" href="{{ route('serveis.edit', $servei_zona->id) }}">Modificar</a></td>
                        <td>
                            <form action="{{ route('serveis.destroy', $servei_zona->id)}}" method="post" onsubmit="return confirm('Estàs segur de voler eliminar aquesta assignació?');">
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
