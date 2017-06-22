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
			<div class="col-md-6">
				<h1>Clase</h1>

				<small>Precio</small>
				<h3>$500</h3>
				<form action="{{ url('/carrito') }}" method="post">
{!! csrf_field() !!}
				<input type="hidden" name="clase" value="1">

				<strong>Elije una fecha</strong>
				<div class="form-group">

					<div class="col-sm-9">
						<div class="input-group">
							<input class="form-control datepicker" type="text"  name="fecha" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						</div>
					</div>
				</div>

				<br>
				<strong>Elije tu horario y coach</strong>
				<select class="form-control" name="horario">
					<option value="">selecciona</option>
					<option value="1">8:00 - Coach 1 - 4.6 ★ </option>
				</select>
				<button  type="submit"class="btn btn-primary" >Agregar al carrito</button>
			</form>
			</div>
			<div class="col-md-6">

			</div>
		</div>



		</section>


@endsection
