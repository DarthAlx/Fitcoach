@extends('plantilla')

@section('pagecontent')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Registrarse</div>
				<div class="panel-body">
					@include('content_holders.notificaciones')

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/registro') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Correo electrónico</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Registrar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
  @endsection











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
          <h3>Termina tu perfil</h3>
					<p>Agrega tu información para completar tu registro</p>
          <form class="row" action="{{ url('/entrar') }}" method="post">
            <p class="col-sm-6">
    					<label>Usuario</label><br>
    					<input class="form-control" type="email" value="{{ old('email') }}" placeholder="tu@email.com" name="email">
    				</p>
    				<p class="col-sm-6">
    					<label>Contraseña</label><br>
    					<input class="form-control" type="password" value="" placeholder="" name="password">
              {!! csrf_field() !!}
    				</p>


              <div class="checkbox col-sm-12">
                  <label><input name="remember" type="checkbox"> Recordarme</label>
              </div>

            <div class="col-sm-12">
              <input class="btn btn-primary" type="submit" value="Enviar">
              <a href="{{ url('password/email') }}" style="float: right;">¿Olvidaste tu contraseña?</a>
            </div>

          </form>
        <!--/div>
      </div-->
    </div>











           <div class="col-sm-6">
       			<!--div class="panel panel-default">
       				<div class="panel-heading"></div>
       				<div class="panel-body"-->
                <h3>Registrarse</h3>

       					<form class="form-horizontal" role="form" method="POST" action="{{ url('/registro') }}">
       						<input type="hidden" name="_token" value="{{ csrf_token() }}">

       						<div class="form-group">
       							<label class="col-md-4 control-label">Nombre</label>
       							<div class="col-md-6">
       								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
       							</div>
       						</div>

       						<div class="form-group">
       							<label class="col-md-4 control-label">Correo electrónico</label>
       							<div class="col-md-6">
       								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
       							</div>
       						</div>

       						<div class="form-group">
       							<label class="col-md-4 control-label">Contraseña</label>
       							<div class="col-md-6">
       								<input type="password" class="form-control" name="password">
       							</div>
       						</div>

       						<div class="form-group">
       							<label class="col-md-4 control-label">Confirmar contraseña</label>
       							<div class="col-md-6">
       								<input type="password" class="form-control" name="password_confirmation">
       							</div>
       						</div>

       						<div class="form-group">
       							<div class="col-md-6 col-md-offset-4">
       								<button type="submit" class="btn btn-primary">
       									Registrar
       								</button>
       							</div>
       						</div>
       					</form>
       				<!--/div>
       			</div-->
       		</div>
          <div class="clear"></div>
		     </div>

     </section>
