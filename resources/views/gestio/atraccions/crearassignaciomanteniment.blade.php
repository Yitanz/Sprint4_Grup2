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
            <h1 class="h2">Manteniment: Assignar Empleats a Atraccio</h1>
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
                    @if($user->id_rol == 3)

                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->cognom1 }}</td>
                        <td>{{ $user->cognom2 }}</td>
                        <td>{{ $user->numero_document }}</td>
                        <td>{{ $user->codi_seg_social }}</td>
                        <td>{{ $user->especialitat }}</td>
                        <td>{{ $user->carrec }}</td>
                        <td>{{ $user->id_horari }}</td>
                        <td><a class="btn btn-success" href="{{ route('empleats.show', $user->id) }}" data-toggle="modal" data-target="#exampleModal">Assignar</a></td>
                    </tr>
                    @endif
                    @endforeach
                    </tbody>
                </table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assignar Empleat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <h4>Data Inici </h4>
            <input type=date name="data_inici_assignacio_empleat">
            </div>
            <div class="col-6">
            <h4>Data Fi </h4>
            <input type=date name="data_inici_fi_empleat">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Finalitzar assignament</button>
      </div>
      </div>
  </div>
</div>
            </div>
        </main>
@endsection
