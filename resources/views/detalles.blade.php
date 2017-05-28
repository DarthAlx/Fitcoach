@extends('plantilla')

@section('pagecontent')

	<div class="container-bootstrap">
		<div class="topclear">
			&nbsp;
		</div>
		<div class="topclear">
			&nbsp;
		</div>
		@include('content_holders.notificaciones')
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#VerifyEmail-step" type="button" class="btn btn-primary btn-circle" disabled="disabled" id="step1">
                <span class="fa fa-id-card-o"></span>
            </a>
            <p>Detalles personales</p>
        </div>
        <div class="stepwizard-step">
            <a href="#ProfileSetup-step" type="button" class="btn btn-default btn-circle" disabled="disabled" id="step2">
                <span class="fa fa-address-book"></span>
            </a>
            <p>Direcciones</p>
        </div>
        <div class="stepwizard-step">
            <a href="#Security-Setup-step" type="button"  class="btn btn-default btn-circle"  disabled="disabled" id="step3">
                <span class="fa fa-credit-card-alt"></span>
            </a>
            <p>Metódos de pago</p>
        </div>
    </div>
</div>
<div class="row setup-content" id="step1-content">
		<div class="col-xs-12">
				<div class="col-md-12">
						 <br/>
						<div class="form-horizontal">
							<form action="{{ url('/completar-registro') }}" method="post"  enctype="multipart/form-data">

										<legend>Ingresa tus detalles personales</legend>
										<br/>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="card-holder-name">Foto de perfil</label>
											<div class="col-sm-9">
												<input class="form-control" type="file" name="photo" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="card-number">Fecha de naciemiento</label>
											<div class="col-sm-9">
												<div class="input-group">
												<input class="form-control datepicker" type="text" value="{{ old('dob') }}" name="dob" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
											</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="card-number">Teléfono</label>
											<div class="col-sm-9">
											 <input class="form-control" type="tel" value="{{ old('tel')}}" placeholder="5555555555" name="tel" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label" for="card-number">Intereses</label>
											<div class="col-sm-9">
											 <input class="form-control" type="text" value="{{ old('intereses')}}" placeholder="Yoga, spinning, zumba..." name="intereses">
											</div>
										</div>
										{!! csrf_field() !!}
										<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
										<div class="form-group">
											<div class="col-sm-12">
												<input class="btn btnCheckout pull-right" type="submit" value="Guardar">
											</div>
										</div>


							</form>
						</div>

				</div>
		</div>
</div>
    <div class="row setup-content" id="step2-content">
        <div class="col-xs-12">
            <div class="col-md-12">
                 <br/>
                <div class="form-horizontal">
									<form action="{{ url('/completar-registro') }}" method="post">

												<legend>Guarda tus direcciones, puedes agregar más desde tu perfil, asi podras llevar tus clases a donde estés.</legend>
												<br/>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Identificador</label>
													<div class="col-sm-9">
														<input class="form-control" type="text" value="{{ old('identificador') }}" name="identificador" placeholder="Ej: Casa, Condominio, Oficina ..." required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-holder-name">Calle</label>
													<div class="col-sm-5">
														<input class="form-control" type="text" value="{{ old('calle') }}" name="calle" required>
													</div>
													<div class="col-sm-2">
														<input class="form-control" type="text" value="{{ old('numero_ext') }}" name="numero_ext" placeholder="No. Ext" required>
													</div>
													<div class="col-sm-2">
														<input class="form-control" type="text" value="{{ old('numero_int') }}" name="numero_int" placeholder="No. Int">
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Colonia</label>
													<div class="col-sm-9">
														<input class="form-control" type="text" value="{{ old('colonia') }}" name="colonia" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Municipio / Delegación</label>
													<div class="col-sm-9">
													 <input class="form-control" type="text" value="{{ old('municipio_del')}}" name="municipio_del" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Código postal</label>
													<div class="col-sm-9">
													 <input class="form-control" type="text" value="{{ old('cp')}}" name="cp" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Estado</label>
													<div class="col-sm-9">
														<select class="form-control" value="{{ old('estado')}}" name="estado" required>
															<option value="">Selecciona una opción</option>
															<option value="CDMX">CDMX</option>
															<option value="Edo. Méx">Edo. Méx</option>
														</select>

													</div>
												</div>
												{!! csrf_field() !!}
												<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
												<div class="form-group">
													<div class="col-sm-12">
														<input class="btn btnCheckout pull-right" type="submit" value="Guardar">
													</div>
												</div>


									</form>
                </div>

            </div>
        </div>
    </div>

    <div class="row setup-content" id="step3-content">
        <div class="col-xs-12">
            <div class="col-md-12">
                <div class="form-horizontal">
									<form action="{{ url('/completar-registro') }}" method="post">

												<legend>Guarda tus tarjetas, es completamente seguro, no guardamos tu código de seguridad.</legend>
												<br/>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Identificador</label>
													<div class="col-sm-9">
														<input class="form-control" type="text" value="{{ old('identificador') }}" name="identificador" placeholder="Ej: Crédito, Mi tarjeta, Banco ..." required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-holder-name">Tarjeta</label>
													<div class="col-sm-5">
														<input class="form-control" type="num" value="{{ old('num') }}" name="num" placeholder="No. de tarjeta" required>
													</div>
													<div class="col-sm-2">
														<select class="form-control" name="mes" required>
															<option value="">Mes de exp.</option>
															<option value="01">01</option>
															<option value="02">02</option>
															<option value="03">03</option>
															<option value="04">04</option>
															<option value="05">05</option>
															<option value="06">06</option>
															<option value="07">07</option>
															<option value="08">08</option>
															<option value="09">09</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
														</select>

													</div>
													<div class="col-sm-2">
														<select class="form-control" name="año" required>
															<option value="">Año de exp.</option>
															<option value="2017">2017</option>
															<option value="2018">2018</option>
															<option value="2019">2019</option>
															<option value="2020">2020</option>
															<option value="2021">2021</option>
															<option value="2022">2022</option>
															<option value="2023">2023</option>
															<option value="2024">2024</option>
															<option value="2025">2025</option>
															<option value="2026">2026</option>
															<option value="2027">2027</option>
															<option value="2028">2028</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Nombre del titular</label>
													<div class="col-sm-9">
														<input class="form-control" type="text" value="{{ old('nombre') }}" name="nombre" required>
													</div>
												</div>
												{!! csrf_field() !!}
												<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
												<div class="form-group">
													<div class="col-sm-12 text-right">

														<input class="btn btnCheckout" type="submit" value="Guardar"> &nbsp; <a href="{{ url('/perfil') }}" class="btn btn-primary">OMITIR</a>
													</div>
												</div>


									</form>
                </div>

            </div>
        </div>
    </div>

</div>


<div class="topclear">
	&nbsp;
</div>
<div class="topclear">
	&nbsp;
</div>

<script type="text/javascript">
function hasDetails(){
	$('#step1').removeClass('btn-primary').addClass('btn-success');
	$('#step2').removeClass('btn-default').addClass('btn-primary');
	$('.setup-content').hide();
	$('#step2-content').show();
	$('#step2-content').find('input:eq(0)').focus();
}
function noDetails(){
	$('#step1').removeClass('btn-default').addClass('btn-primary');
	$('.setup-content').hide();
	$('#step1-content').show();
	$('#step1-content').find('input:eq(0)').focus();
}

function hasAddress(){
	$('#step1').removeClass('btn-primary').addClass('btn-success');
	$('#step2').removeClass('btn-primary').addClass('btn-success');
	$('#step3').removeClass('btn-default').addClass('btn-primary');
	$('.setup-content').hide();
	$('#step3-content').show();
	$('#step3-content').find('input:eq(0)').focus();
}
function noAddress(){
	$('#step2').removeClass('btn-default').addClass('btn-primary');
	$('.setup-content').hide();
	$('#step2-content').show();
	$('#step2-content').find('input:eq(0)').focus();
}

</script>

@if ($tienedetalles)
	@if ($tienedirecciones)
		<script type="text/javascript">
			hasAddress();
		</script>
	@else
	<script type="text/javascript">
		hasDetails();
	</script>
	@endif
@else
	<script type="text/javascript">
		noDetails();
	</script>
@endif



  @endsection
