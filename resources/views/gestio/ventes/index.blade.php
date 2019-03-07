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
          <td>Usuari</td>
          <td>Email</td>
          <td>Número document</td>
          <td>Preu total</td>
          <td>Realització de la compra</td>
          <td></td>
        </tr>
    </thead>
    <tbody>
        @forelse($ventes as $venta)
        @if ($venta->estat === 0)
        <tr style="color:lightgrey;">
        @else
        <tr>
        @endif
            <td>{{$venta->id}}</td>
            <td>{{$venta->nom}} {{$venta->cognom1}} {{$venta->cognom2}}</td>
            <td>{{$venta->email}}</td>
            <td>{{$venta->numero_document}}</td>
            <td>{{$venta->preu}}</td>
            <td>{{$venta->temps_compra}}</td>
            <td><a href="{{ route('ventes.edit',$venta->id)}}" class="btn btn-primary">Detalls</a></td>
        </tr>
        @empty
        <p style="background-color: #e05e5e;text-align: center;font-weight: bold;"> No hi han ventes a llistar</p>
        @endforelse
    </tbody>
  </table>
  <div style="display: table;margin: 0 auto;"> {{ $ventes->links() }} </div>

@endsection
