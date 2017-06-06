@extends('plantilla')
@section('pagecontent')
  @include('content_holders.auth', ['role'=>'usuario'])
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
			@include('content_holders.sidebar', ['menu'=>'direccionesmenu'])
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- direcciones -->
              <h2>Tus direcciones</h2>
              @if (!$user->direcciones->isEmpty())
                   <div class="panel-group" id="direcciones" role="tablist" aria-multiselectable="true">
                     @foreach ($user->direcciones as $direccion)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $direccion->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#direcciones" href="#collapse{{ $direccion->id }}" aria-expanded="false" aria-controls="collapse{{ $direccion->id }}">
                             <a role="button">
                               {{ Ucfirst($direccion->identificador) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $direccion->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $direccion->id }}">
                           <div class="panel-body">
                             <div class="direccion">
                               <div class="editar">
                                 <div class="col-md-12">
                                      <br/>
                                     <div class="form-horizontal">
                                 <form action="{{ url('/actualizar-direccion') }}/{{ $direccion->id }}" method="post">


               												<div class="form-group">
               													<label class="col-sm-3 control-label" for="card-number">Identificador</label>
               													<div class="col-sm-9">
               														<input class="form-control" type="text" value="{{ Ucfirst($direccion->identificador) }}" id="identificador{{ $direccion->id }}" disabled name="identificador" placeholder="Ej: Casa, Condominio, Oficina ..." required>
               													</div>
               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label" for="card-holder-name">Calle</label>
               													<div class="col-sm-5">
               														<input class="form-control" type="text" value="{{ Ucfirst($direccion->calle) }}" id="calle{{ $direccion->id }}" disabled name="calle" required>
               													</div>
               													<div class="col-sm-2">
               														<input class="form-control" type="text" value="{{ Ucfirst($direccion->numero_ext) }}" id="numero_ext{{ $direccion->id }}" disabled name="numero_ext" placeholder="No. Ext" required>
               													</div>
               													<div class="col-sm-2">
               														<input class="form-control" type="text" value="{{ Ucfirst($direccion->numero_int) }}" id="numero_int{{ $direccion->id }}" disabled name="numero_int" placeholder="No. Int">
               													</div>
               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label" for="card-number">Colonia</label>
               													<div class="col-sm-9">
               														<input class="form-control" type="text" value="{{ Ucfirst($direccion->colonia) }}" id="colonia{{ $direccion->id }}" disabled name="colonia" required>
               													</div>
               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label" for="card-number">Municipio / Delegación</label>
               													<div class="col-sm-9">
               													 <input class="form-control" type="text" value="{{ Ucfirst($direccion->municipio_del) }}" id="municipio_del{{ $direccion->id }}" disabled name="municipio_del" required>
               													</div>
               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label" for="card-number">Código postal</label>
               													<div class="col-sm-9">
               													 <input class="form-control" type="text" value="{{ Ucfirst($direccion->cp) }}" id="cp{{ $direccion->id }}" disabled name="cp" required>
               													</div>
               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label" for="card-number">Estado</label>
               													<div class="col-sm-9">
               														<select class="form-control" value="{{ Ucfirst($direccion->estado) }}" disabled name="estado" id="estado{{ $direccion->id }}" required>
               															<option value="">Selecciona una opción</option>
               															<option value="CDMX">CDMX</option>
               															<option value="Edo. Méx">Edo. Méx</option>
               														</select>
                                          <script type="text/javascript">
                                            if (document.getElementById('estado{{ $direccion->id }}') != null) document.getElementById('estado{{ $direccion->id }}').value = '{!! $direccion->estado !!}';
                                          </script>

               													</div>
               												</div>
               												{!! csrf_field() !!}
               												<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
               												<div class="form-group">
               													<div class="col-sm-12 text-right">
               														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $direccion->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $direccion->id }}" onclick="habilitar({{ $direccion->id }})">Editar</a> &nbsp;

                                          <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $direccion->id }}').click();">Borrar</a>
               													</div>
               												</div>
               									</form>
                                <form style="display: none;" action="{{ url('/eliminar-direccion') }}/{{ $direccion->id }}" method="post">
                                  {!! csrf_field() !!}
                                  <input type="submit" id="botoneliminar{{ $direccion->id }}">
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

                     @endforeach

                   </div>

           @else
             <p>No tienes direcciones</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#direcciones" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar dirección
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="direccion">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-direccion') }}" method="post">


                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Identificador</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('identificador') }}" id="identificadorNuevo"  name="identificador" placeholder="Ej: Casa, Condominio, Oficina ..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Calle</label>
                            <div class="col-sm-5">
                              <input class="form-control" type="text" value="{{ old('calle') }}" id="calleNuevo"  name="calle" required>
                            </div>
                            <div class="col-sm-2">
                              <input class="form-control" type="text" value="{{ old('numero_ext') }}" id="numero_extNuevo"  name="numero_ext" placeholder="No. Ext" required>
                            </div>
                            <div class="col-sm-2">
                              <input class="form-control" type="text" value="{{ old('numero_int') }}" id="numero_intNuevo"  name="numero_int" placeholder="No. Int">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Colonia</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('colonia') }}" id="coloniaNuevo"  name="colonia" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Municipio / Delegación</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('municipio_del') }}" id="municipio_delNuevo"  name="municipio_del" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Código postal</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('cp') }}" id="cpNuevo"  name="cp" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Estado</label>
                            <div class="col-sm-9">
                              <select class="form-control"  name="estado" id="estadoNuevo" required>
                                <option value="">Selecciona una opción</option>
                                <option value="CDMX">CDMX</option>
                                <option value="Edo. Méx">Edo. Méx</option>
                              </select>
                            </div>
                          </div>
                          {!! csrf_field() !!}
                          <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                          <div class="form-group">
                            <div class="col-sm-12 text-right">
                              <input class="btn btn-success" type="submit" value="Guardar" id="botonguardarNuevo">
                            </div>
                          </div>
                    </form>
                  </div>
              </div>
                   </div>

                 </div>
               </div>
             </div>
           </div>

           <!--termina direcciones -->


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
