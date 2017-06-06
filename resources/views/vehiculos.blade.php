@extends('plantilla')
@section('pagecontent')
  @include('content_holders.auth', ['role'=>'instructor'])
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
			@include('content_holders.sidebar2', ['menu'=>'vehiculosmenu'])
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- vehiculos -->
              <h2>Tus vehiculos</h2>
              @if (!$user->vehiculos->isEmpty())
                   <div class="panel-group" id="vehiculos" role="tablist" aria-multiselectable="true">
                     @foreach ($user->vehiculos as $vehiculo)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $vehiculo->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#vehiculos" href="#collapse{{ $vehiculo->id }}" aria-expanded="false" aria-controls="collapse{{ $vehiculo->id }}">
                             <a role="button">
                               {{ Ucfirst($vehiculo->identificador) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $vehiculo->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $vehiculo->id }}">
                           <div class="panel-body">
                             <div class="vehiculo">
                               <div class="editar">
                                 <div class="col-md-12">
                                      <br/>
                                     <div class="form-horizontal">
                                 <form action="{{ url('/actualizar-vehiculo') }}/{{ $vehiculo->id }}" method="post">


               												<div class="form-group">
               													<label class="col-sm-3 control-label">Identificador</label>
               													<div class="col-sm-9">
               														<input class="form-control" type="text" value="{{ Ucfirst($vehiculo->identificador) }}" id="identificador{{ $vehiculo->id }}" disabled name="identificador" placeholder="Ej: Auto, Chevrolet, Harley ..." required>
               													</div>
               												</div>
                                      <div class="form-group">
               													<label class="col-sm-3 control-label" >Tipo</label>
               													<div class="col-sm-9">
               														<select class="form-control" disabled name="tipo" id="tipo{{ $vehiculo->id }}" required>
               															<option value="">Selecciona una opción</option>
               															<option value="Auto">Auto</option>
               															<option value="Motocicleta">Motocicleta</option>
               														</select>
                                          <script type="text/javascript">
                                            if (document.getElementById('tipo{{ $vehiculo->id }}') != null) document.getElementById('tipo{{ $vehiculo->id }}').value = '{!! $vehiculo->tipo !!}';
                                          </script>

               													</div>
               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label">Modelo</label>
               													<div class="col-sm-9">
               														<input class="form-control" type="text" value="{{ Ucfirst($vehiculo->modelo) }}" id="modelo{{ $vehiculo->id }}" disabled name="modelo" required>
               													</div>

               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label">Color</label>
               													<div class="col-sm-9">
               														<input class="form-control" type="text" value="{{ Ucfirst($vehiculo->color) }}" id="color{{ $vehiculo->id }}" disabled name="color" required>
               													</div>
               												</div>
               												<div class="form-group">
               													<label class="col-sm-3 control-label">Placa</label>
               													<div class="col-sm-9">
               													 <input class="form-control" type="text" value="{{ Ucfirst($vehiculo->placa) }}" id="placa{{ $vehiculo->id }}" disabled name="placa" required>
               													</div>
               												</div>


               												{!! csrf_field() !!}
               												<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
               												<div class="form-group">
               													<div class="col-sm-12 text-right">
               														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $vehiculo->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $vehiculo->id }}" onclick="habilitar({{ $vehiculo->id }})">Editar</a> &nbsp;

                                          <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $vehiculo->id }}').click();">Borrar</a>
               													</div>
               												</div>
               									</form>
                                <form style="display: none;" action="{{ url('/eliminar-vehiculo') }}/{{ $vehiculo->id }}" method="post">
                                  {!! csrf_field() !!}
                                  <input type="submit" id="botoneliminar{{ $vehiculo->id }}">
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
             <p>No tienes vehiculos</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#vehiculos" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar vehiculo
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="vehiculo">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-vehiculo') }}" method="post">


                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Identificador</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('identificador') }}" id="identificadorNuevo"  name="identificador" placeholder="Ej: Auto, Chevrolet, Harley ..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" >Tipo</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="tipo" id="tipoNuevo" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Auto">Auto</option>
                                <option value="Motocicleta">Motocicleta</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Modelo</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" value="{{ old('modelo') }}" id="modeloNuevo"  name="modelo" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Color</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('color') }}" id="colorNuevo"  name="color" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label">Placa</label>
                            <div class="col-sm-9">
                             <input class="form-control" type="text" value="{{ old('placa') }}" id="placaNuevo"  name="placa" required>
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

           <!--termina vehiculos -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('identificador'+valor).disabled=false;
    document.getElementById('modelo'+valor).disabled=false;
    document.getElementById('color'+valor).disabled=false;
    document.getElementById('tipo'+valor).disabled=false;
    document.getElementById('placa'+valor).disabled=false;
    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>
@endsection
