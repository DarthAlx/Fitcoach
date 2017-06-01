@extends('plantilla')
@section('pagecontent')
<div class="container-bootstrap">
  @include('content_holders.notificaciones')
  <div class="topclear">
    &nbsp;
  </div>

    <div class="row profile">
      <div class="col-sm-12">
        @include('content_holders.notificaciones')
      </div>
		<div class="col-md-3">
			@include('content_holders.sidebar')
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
                        @if ($user->detalles_instructor)
                        <form action="{{ url('/actualizar-perfil-instructor') }}" method="post">
                        @else
                          <form action="{{ url('/llenar-perfil-instructor') }}" method="post">
                        @endif
                          <div class="form-group">
                            <label class="col-sm-3 control-label">RFC</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ $user->detalles_instructor->rfc }}"  name="rfc">
                            </div>
                          </div>
                         <div class="form-group">
                           <label class="col-sm-3 control-label">Fecha de naciemiento</label>
                           <div class="col-sm-9">
                             <div class="input-group">
                             <input class="form-control datepicker" type="text" value="{{ $user->detalles_instructor->dob }}" name="dob" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                           </div>
                           </div>
                         </div>
                         <div class="form-group">
                           <label class="col-sm-3 control-label">Teléfono</label>
                           <div class="col-sm-9">
                            <input class="form-control" type="tel" value="{{ $user->detalles_instructor->tel }}" placeholder="5555555555" name="tel" required>
                           </div>
                         </div>

                         {!! csrf_field() !!}
                         @if ($user->detalles_instructor)
                           <input type="hidden" value="{{ $user->detalles_instructor->id }}" name="detalles_id">
                         @else
                           <input type="hidden" value="{{ $user->id }}" name="user_id">
                         @endif

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
