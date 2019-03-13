  @extends("layouts.gestio")

  @section("navbarIntranet")
  @endsection
  @section("menuIntranet")
  @endsection
  @section("content")
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

            <div class="row">
              <div class="col-4">
                <label for="example-date-input" class="col-6 col-form-label">Data inici</label>
                <input class="form-control" name="data_inici_assignacio_empleat" type="date" id="example-date-input">
              </div>
              <div class="col-4">
                <label for="example-date-input" class="col-6 col-form-label">Data fi</label>
                <input class="form-control" name="data_fi_assignacio_empleat" value="12/02/1998" type="date" id="example-date-input">
              </div>
              <div class="col-4">
  <br>
  <br>

        <a href="{{ route('atraccions.crearassignaciomanteniment', $atraccio->id)}}" class="btn btn-primary btn-sm">Empleats</a>
              </div>
            </div>


              </div>
          </main>
  @endsection
