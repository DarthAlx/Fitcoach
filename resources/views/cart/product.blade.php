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


					<h3 class="precio" id="precio">${{$clase->precio}}</h3>
					<h3 class="precio" id="precio_especial" style="display:none">${{$clase->precio_especial}}</h3>
					<script type="text/javascript">
						@if ($clase->precio_especial!="")
							$("#precio_especial").show();
							$("#precio").css('text-decoration', 'line-through');
						@endif
					</script>
					<form action="{{ url('/addtocart') }}" method="post">
						<input type="hidden"  name="_token" id="token" value="{{csrf_token()}}">
						<input type="hidden" name="clase_id" id="clase_id" value="{{$clase->id}}">
						<br>
						<strong>Buscar horario</strong>
						<div class="input-group">
						<input type="text" class="datepicker form-control" name="fecha" id="fecha" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
					</div>



						<strong>Elije tu horario</strong>

						<select class="selector-horario form-control" name="horario" id="horario" required>
							<option value="">selecciona</option>
						</select>
						<br>
						<strong>Elije tu dirección</strong>
						<select class="form-control" name="direccion">
							<option value="">selecciona</option>
							@foreach ($user->direcciones as $direccion)
								<option value="{{$direccion->id}}">{{$direccion->identificador}}</option>
							@endforeach
						</select>

						<input type="hidden" name="nombre" value="{{$clase->nombre}}">
						@if ($clase->precio_especial!="")
							<input type="hidden" name="precio" id="inputprecio" value="{{$clase->precio_especial}}">
						@else
							<input type="hidden" name="precio" id="inputprecio" value="{{$clase->precio}}">
						@endif
						<input type="hidden" name="tipo" value="particular">
						<p>&nbsp;</p>
						<input type="submit" class="btn btn-primary" value="Agregar al carrito">
					</form>
						<p>&nbsp;</p>
				</div>
			</div>
			<div class="col-sm-6 col-md-4">
				@if (!$clase->zonas->isEmpty())
					<div class="product_large">
						<h1>{{$clase->nombre}}</h1>
						<form action="{{ url('/addtocart') }}" method="post">
							<input type="hidden"  name="_token" id="token" value="{{csrf_token()}}">
							<input type="hidden" name="clase_id" id="clase_id" value="{{$clase->id}}">
							<br>

							<strong>Elije tu horario</strong>
							<select class="selector-horario form-control" name="zona" id="zona" required>
								<option value="">selecciona</option>
								@foreach ($clase->zonas as $zona)
									<option value="{{$zona->id}}">{{$zona->identificador}} - {{$zona->fecha}}</option>
								@endforeach
							</select>

								@foreach ($clase->zonas as $zona)
									<p class="zonas" id="zona{{$zona->id}}" style="display:none">
										Precio: <strong class="preciozona">{{$zona->precio_zona}}</strong> <br>
										Dirección: {{ $zona->direccion}}<br>
										Horario: {{$zona->horario}}<br>
										<?php $coach=App\User::find($zona->coach) ?>
										Instructor: {{$coach->name}} | 4.6 ★
									</p>
								@endforeach


							<input type="hidden" name="nombre" value="{{$clase->nombre}}">
							<input type="hidden" name="precio" id="precio_zona">

							<input type="hidden" name="tipo" value="fitcoach">
							<p>&nbsp;</p>
							<input type="submit" class="btn btn-primary" value="Agregar al carrito">
						</form>
							<p>&nbsp;</p>
					</div>
				@endif

			</div>
		</div>



		</section>


		<script type="text/javascript">
		$(document).ready(function() {
			$("#fecha").on("change paste keyup", function() {
				if ($('#fecha').val().length==10) {
					fecha = $('#fecha').val();
					_token= $('#token').val();
					clase=$('#clase_id').val();

					$.post("http://localhost/Fitcoach/llenar_horarios", {
					fecha : fecha,
					_token : _token,
					clase : clase
					}, function(data) {
						$("#horario").html(data);
					});
				}






			});
			$("#zona").on("change paste keyup", function() {
				valor=$("#zona").val();
				precio=$('#zona'+valor+ " .preciozona").html();
				$("#precio_zona").val(precio)
				$('.zonas').hide();
				$('#zona'+valor).show();
			});
		});
		</script>
@endsection
