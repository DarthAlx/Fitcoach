@extends('plantilla')

@section('pagecontent')

<section class="container-bootstrap">
	<div class="row">
		<div class="topclear">
			&nbsp;
		</div>
		<div class="col-xs-12">
			@include('content_holders.notificaciones')
		</div>

		<div class="col-sm-6">
		<!--div class="panel panel-default">
			<div class="panel-heading"></div>
			<div class="panel-body"-->
				<h3>Completa tu perfil</h3>
				<p>Agrega tu información para completar tu registro</p>
				<form action="{{ url('/completar-registro') }}" method="post">
					<p>
						<label>Foto de perfil</label><br>
						<input class="form-control" type="text" value="{{ old('foto') }}" name="foto">
					</p>
					<p>
						<label>Fecha de naciemiento</label><br>
						<div class="input-group">

						  <input class="form-control datepicker" type="text" value="{{ old('dob') }}" name="dob"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						</div>
					</p>
					<p>
						<label>Teléfono</label><br>
						<input class="form-control" type="tel" value="{{ old('tel')}}" placeholder="5555555555" name="tel">
						{!! csrf_field() !!}
					</p>


					<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">

						<input class="btn btn-primary" type="submit" value="Guardar">

				</form>
			<!--/div>
		</div-->
	</div>












				<div class="clear"></div>
			 </div>

	 </section>

  @endsection
