@extends('plantilla')

@section('pagecontent')
<section class="container">



  <div class="topclear">
    &nbsp;
  </div>
      <div class="ourTeam2">
    <div class="blockTitle">Residenciales</div>
    <div class="teamItemWrap clear">

      @foreach ($condominios as $condominio)
        <div class="teamItem">
          <a href="{{url('condominio')}}/{{$condominio->id}}"><img src="{{url('uploads/clases')}}/{{$condominio->imagen}}" alt=""></a>
          <div class="overlay">
            <div class="teamItemNameWrap">
              <a style="text-decoration:none;" href="{{url('condominio')}}/{{$condominio->id}}"><h3>{{ucfirst($condominio->identificador)}}</h3></a>
            </div>
							<p>${{$condominio->precio}}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
