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
            <h1 class="h2">General: Assignar Empleats a Atraccio</h1>
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
                  <input class="form-control" type="text" name="busqueda_habitacio" placeholder="Filtrar...">
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="buscar_habitacio" value="Filtrar">
                  </div>
                </div>
              </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                        <th>Nom</th>
                        <th>Cognom1</th>
                        <th>Cognom2</th>
                        <th>Num Document</th>
                        <th>Codi Seg Social</th>
                        <th>Especialitat</th>
                        <th>Càrrec</th>
                        <th>Horari</th>
                        <th colspan="3">Accions</th>
                        </tr>
                    </thead>
                <tbody>

                    @foreach($users as $user)
                    @if($user->id_rol == 5)
                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->cognom1 }}</td>
                        <td>{{ $user->cognom2 }}</td>
                        <td>{{ $user->numero_document }}</td>
                        <td>{{ $user->codi_seg_social }}</td>
                        <td>{{ $user->especialitat }}</td>
                        <td>{{ $user->carrec }}</td>
                        <td>{{ $user->id_horari }}</td>
                        <td><a class="btn btn-success" href="{{ route('empleats.show', $user->id) }}">Assignar</a></td>
                    </tr>
                    @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>
@endsection
