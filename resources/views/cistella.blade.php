@extends("layouts.plantilla")

@section("menu1")
@endsection
@section("menu2")
@endsection
@section("body")
@if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div><br />
@endif

<table class="table table-striped">
  <thead>
      <tr>
        <td>Producte</td>
        <td>Mida</td>
        <td>Viatges</td>
        <td>Quantitat</td>
        <td>Preu</td>
        <td></td>
      </tr>
  </thead>
  <tbody>
      @forelse($linia_cistella as $cistella)
      <tr>
          <td>{{$cistella->nom}}</td>
          <td>{{$cistella->mida}}</td>
          @if ($cistella->tickets_viatges == 100)
          <td>∞</td>
          @else
          <td>
            <select class="form-control" name="num_viatges_mod" style="width:60px;">
              @if ($cistella->tickets_viatges == 3)
              <option selected value=3>3</option>
              <option value=6>6</option>
              @else
              <option selected value=6>6</option>
              <option value=3>3</option>
              @endif
          </select>
          </td>
          @endif
          <td><input type="number" id="quantitat_mod" name="tentacles" min="1" max="10" value="{{$cistella->quantitat}}" class="form-control" style="width:60px;"></td>
          <td>{{$cistella->preu * $cistella->quantitat}}€</td>
          <td>
              <form action="{{ route('cistella',$cistella->id)}}" method="post" onsubmit="return confirm('Estàs segur de que vols eliminar el producte?');">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id_linia_producte" value="{{$cistella->id}}">
                <button class="btn btn-danger" type="submit">X</button>
              </form>
          </td>
      </tr>
      <p style="display:none"> {{$total = $total + ($cistella->preu* $cistella->quantitat)}} </p>
      @empty
      <p style="background-color: #e05e5e;text-align: center;font-weight: bold;"> No hi han productes a llistar</p>
      @endforelse
      @if ($total > 0)
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight: bold;">TOTAL</td>
        <td style="font-weight: bold;">{{$total}}€</td>
        <td><a href="/compra" style="text-decoration: none;"><button type="button" class="btn btn-success" >Comprar</button> </a></td>
      </tr>
      @else
      @endif

  </tbody>
</table>

@endsection
@section("footer")
@endsection
