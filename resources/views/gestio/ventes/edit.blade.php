@extends("layouts.gestio")

@section("navbarIntranet")
@endsection
@section("menuIntranet")
@endsection
@section("content")
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif

  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Tipus producte</td>
          <td>Mida</td>
          <td>Viatges tickets</td>
          <td>Path foto</td>
          <td>Quantitat</td>
          <td>Preu</td>
        </tr>
    </thead>
    <tbody>
        @forelse($ventes as $venta)
        <tr>
            <td>{{$venta->id}}</td>
            <td>{{$venta->nom}}</td>
            <td>{{$venta->mida}}</td>
            @if ($venta->tickets_viatges == 100)
            <td></td>
            @else
            <td>{{$venta->tickets_viatges}}</td>
            @endif
            <td><a href="#" data-toggle="modal" data-target="#exampleModal{{$venta->id}}">{{$venta->foto_path}}</a></td>
            @if (! is_null($venta->foto_path))
            <!-- MODAL FOTO -->
            <div class="modal fade" id="exampleModal{{$venta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" style="width:120%;">
                  <div class="modal-body">
                    <img src="{{ asset($venta->foto_path) }}" style="display:block;margin:auto;width:100%">
                  </div>
                </div>
              </div>
            </div>

            <!-- FI MODAL FOTO -->
            @else
            @endif
            <td>{{$venta->quantitat}}</td>
            <td>{{$preu_linia = $venta->preu * $venta->quantitat}}€</td>
        </tr>
        @empty
        <p style="background-color: #e05e5e;text-align: center;font-weight: bold;"> No hi han productes a llistar</p>
        @endforelse
    </tbody>
    <tr style="font-weight: bold;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>TOTAL</td>
        <td>{{$venta->preu_total}}€</td>
    </tr>
  </table>
<a href="{{ url()->previous() }}" class="btn btn-primary" style="float: right;">Enrere</a>

@endsection
