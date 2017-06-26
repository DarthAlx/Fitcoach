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
					<h1>Clase</h1>


					<h3 class="precio">$500 MXN</h3>
					<form action="{{ url('/carrito') }}" method="post">
						{!! csrf_field() !!}
						<input type="hidden" name="clase" value="1">

						<strong>Elije una fecha</strong>
						<div class="form-group">
								<div class="input-group">
									<input class="form-control datepicker" type="text"  name="fecha" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								</div>
						</div>
						<br>
						<strong>Elije tu horario y coach</strong>
						<select class="form-control" name="horario">
							<option value="">selecciona</option>
							<option value="1">{{$horario->hora}} - {{$horario->user->name}} - 4.6 ★ </option>
						</select>
						<br>
						<strong>Elije tu dirección</strong>
						<select class="form-control" name="direccion">
							<option value="">selecciona</option>
							@foreach ($direcciones as $direccion)
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
