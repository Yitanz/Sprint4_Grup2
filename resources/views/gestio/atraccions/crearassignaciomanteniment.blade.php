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

                    <tr>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->cognom1 }}</td>
                        <td>{{ $user->cognom2 }}</td>
                        <td>{{ $user->numero_document }}</td>
                        <td>{{ $user->codi_seg_social }}</td>
                        <td>{{ $user->especialitat }}</td>
                        <td>{{ $user->carrec }}</td>
                        <td>{{ $user->id_horari }}</td>
                        <td><a class="btn btn-success" href="#" data-toggle="modal" data-target="#ModalEmpleat{{$user->id}}">Assignar</a></td>
                    </tr>

                    <!-- Modal -->
<div class="modal fade" id="ModalEmpleat{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Assignar Empleat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('atraccions.guardarAssignacio', $atraccio->id) }}" >
      @csrf
      <div class="modal-body">
        <div class="row">
          <div class="col-6">
            <h4>Atraccio:</h4>
            <input type="text" class="form-control" name="id_atraccio" value="{{ $atraccio->id }}" hidden/>
            <input type="text" class="form-control" name="nom_atraccio" value="{{ $atraccio->nom_atraccio }}" disabled />
          </div>
          <div class="col-6">
            <h4>Empleat:</h4>
            <input type="text" class="form-control" name="id_empleat" value="{{ $user->id }}" hidden />
            <input type="text" class="form-control" name="nom_empleat" disabled value="{{ $user->nom}}"/>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <h4>Data Inici </h4>
            <input type=date name="data_inici_assignacio_empleat">
            </div>
            <div class="col-6">
            <h4>Data Fi </h4>
            <input type=date name="data_fi_assignacio_empleat">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Finalitzar assignament</button>
      </div>
      </form>
      </div>
  </div>
</div>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </main>
@endsection
