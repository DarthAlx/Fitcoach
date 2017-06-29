@extends('plantilla')
@section('pagecontent')

	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="row">
			<div class="col-xs-12">
				@include('content_holders.notificaciones')
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-2">
				<div class="product_large">
					<h1>{{$clase->nombre}}</h1>


					<h3 class="precio">${{$clase->precio}}</h3>
					<form action="{{ url('/carrito') }}" method="post">
						{!! csrf_field() !!}
						<input type="hidden" name="clase_id" value="{{$clase->id}}">
						<br>
						<strong>Buscar horario</strong>
						<select class="datepicker selector-horario form-control" name="horario" id="horario" required>
							<option value="">selecciona</option>
							@foreach ($clase->horarios as $horario)
								<option value="{{$horario->id}}">{{$horario->fecha}} | {{$horario->hora}} | {{strtok($horario->user->name, " ")}} | 4.6 ★ </option>
							@endforeach
						</select>
						<br>
						<strong>Elije tu dirección</strong>
						<select class="form-control" name="direccion">
							<option value="">selecciona</option>
							@foreach ($user->direcciones as $direccion)
								<option value="{{$direccion->id}}">{{$direccion->identificador}}</option>
							@endforeach

						</select>
						<p>&nbsp;</p>
						<a href="#" class="btn btn-primary pull-right" >Agregar al carrito</a>
						<p>&nbsp;</p>
					</form>
				</div>

			</div>
			<div class="col-sm-6">

			</div>
		</div>



		</section>



@endsection
