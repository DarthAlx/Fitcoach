@extends('plantilla')
@section('pagecontent')
<div class="container-bootstrap">
  @include('content_holders.notificaciones')
  <div class="topclear">
    &nbsp;
  </div>

    <div class="row profile">
      @if ($mensaje!=null)
        <div class="alert alert-info alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <ul>
              <li>{{ $mensaje }}</li>
          </ul>
        </div>
      @endif
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="{{ url('uploads/avatars') }}/{{ $user->detalles->photo }}" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ Auth::user()->name }}
					</div>
					<div class="profile-usertitle-job">
						{{ ucfirst(Auth::user()->role) }}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">

          <form style="display:none;" action="{{ url('/cambiar-foto') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $user->detalles->id }}">
            <input type="file" name="photo" id="cambiarfoto" onchange="javascript: document.getElementById('botoncambiarfoto').click();" required>
            {!! csrf_field() !!}
            <input type="submit" id="botoncambiarfoto">
          </form>
					<button type="button" onclick="javascript: document.getElementById('cambiarfoto').click();" class="btn btn-warning btn-sm" id="botoncambiar">Cambiar foto</button>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="{{ url('/perfil') }}">
							<i class="fa fa-id-card-o" aria-hidden="true"></i></i>
							Detalles </a>
						</li>
            <li>
							<a href="#">
							<i class="fa fa-calendar" aria-hidden="true"></i></i>
							Clases </a>
						</li>
						<li>
							<a href="{{ url('/direcciones') }}">
							<i class="fa fa-address-book" aria-hidden="true"></i>
							Direcciones </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
							Tarjetas </a>
						</li>

					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- perfil -->
              <h2>Tu perfil</h2>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingPerfil">
                  <h4 class="panel-title" data-toggle="collapse" data-parent="#direcciones" href="#collapsePerfil" aria-expanded="false" aria-controls="collapsePerfil">
                    <a role="button">
                      Editar detalles
                    </a>
                  </h4>
                </div>
                <div id="collapsePerfil" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingPerfil">
                  <div class="panel-body">
                    <div class="direccion">
                      <div class="editar">
                        <div class="col-md-12">
                             <br/>
                            <div class="form-horizontal">
                        <form action="{{ url('/actualizar-perfil') }}" method="post">
                         <div class="form-group">
                           <label class="col-sm-3 control-label" for="card-number">Fecha de naciemiento</label>
                           <div class="col-sm-9">
                             <div class="input-group">
                             <input class="form-control datepicker" type="text" value="{{ $user->detalles->dob }}" name="dob" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                           </div>
                           </div>
                         </div>
                         <div class="form-group">
                           <label class="col-sm-3 control-label" for="card-number">Teléfono</label>
                           <div class="col-sm-9">
                            <input class="form-control" type="tel" value="{{ $user->detalles->tel }}" placeholder="5555555555" name="tel" required>
                           </div>
                         </div>
                         <div class="form-group">
                           <label class="col-sm-3 control-label" for="card-number">Intereses</label>
                           <div class="col-sm-9">
                            <input class="form-control" type="text" value="{{ $user->detalles->intereses }}" placeholder="Yoga, spinning, zumba..." name="intereses">
                           </div>
                         </div>
                         {!! csrf_field() !!}
                         <input type="hidden" value="{{ $user->detalles->id }}" name="detalles_id">
                         <div class="form-group">
                           <div class="col-sm-12">
                             <input class="btn btnCheckout pull-right" type="submit" value="Guardar">
                           </div>
                         </div>
                       </form>


                     </div>

                     <h3>Actualizar contraseña</h3>

                     <div class="form-horizontal">
                 <form action="{{ url('/actualizar-contraseña') }}" method="post">

                  <div class="form-group">
                    <label class="col-sm-3 control-label" >Nueva contraseña</label>
                    <div class="col-sm-9">
                     <input class="form-control" type="password" name="password" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label" >Confirmar contraseña</label>
                    <div class="col-sm-9">
                     <input class="form-control" type="password" name="password_confirmation">
                    </div>
                  </div>
                  {!! csrf_field() !!}
                  <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input class="btn btnCheckout pull-right" type="submit" value="Actualizar">
                    </div>
                  </div>
                </form>


              </div>

                 </div>
                      </div>
                      <div class="text-right">

                      </div>
                    </div>
                  </div>
                </div>
              </div>





            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('identificador'+valor).disabled=false;
    document.getElementById('calle'+valor).disabled=false;
    document.getElementById('numero_ext'+valor).disabled=false;
    document.getElementById('numero_int'+valor).disabled=false;
    document.getElementById('colonia'+valor).disabled=false;
    document.getElementById('municipio_del'+valor).disabled=false;
    document.getElementById('cp'+valor).disabled=false;
    document.getElementById('estado'+valor).disabled=false;
    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>
@endsection
