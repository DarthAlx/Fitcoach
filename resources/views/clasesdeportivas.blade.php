@extends('plantilla')

@section('pagecontent')
<section class="container">



  <div class="topclear">
    &nbsp;
  </div>
      <div class="ourTeam2">
    <div class="blockTitle">clases deportivas</div>
    <div class="teamItemWrap clear">

      @foreach ($clases as $clase)
        <div class="teamItem">
          <a href="{{url('clase')}}/{{$clase->id}}"><img src="{{url('uploads/clases')}}/{{$clase->imagen}}" alt=""></a>
          <div class="overlay">
            <div class="teamItemNameWrap">
              <a style="text-decoration:none;" href="{{url('clase')}}/{{$clase->id}}"><h3>{{ucfirst($clase->nombre)}}</h3></a>
            </div>
            @if ($clase->precio_especial!="")
							<p>${{$clase->precio_especial}}</p>
						@else
							<p>${{$clase->precio}}</p>
						@endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
