@extends('plantilla')
@section('pagecontent')
  @include('content_holders.doubleauth', ['role'=>'superadmin','role2'=>'admin'])
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
			@include('content_holders.sidebar3', ['menu'=>'condominiosmenu'])
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- condominios -->
              <h2>Condominios</h2>
              @if (!$condominios->isEmpty())
                   <div class="panel-group" id="condominios" role="tablist" aria-multiselectable="true">
                     @foreach ($condominios as $condominio)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $condominio->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#condominios" href="#collapse{{ $condominio->id }}" aria-expanded="false" aria-controls="collapse{{ $condominio->id }}">
                             <a role="button">
                                   {{ Ucfirst($condominio->identificador) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $condominio->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $condominio->id }}">
                           <div class="panel-body">
                             <div class="condominio">
                               <div class="editar">
                                 <div class="col-md-12">
                                      <br/>
                                     <div class="form-horizontal">
                                 <form action="{{ url('/actualizar-condominio') }}/{{ $condominio->id }}" method="post"  enctype="multipart/form-data">
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Identificador</label>
                                     <div class="col-sm-9">
                                       <input id="identificador{{ $condominio->id }}" class="form-control" type="text" value="{{ $condominio->identificador }}" name="identificador" disabled required>
                                     </div>
                                   </div>
                                   <div class="form-group">
               											<label class="col-sm-3 control-label">Imagen (solo si se desea reemplazar)</label>
               											<div class="col-sm-9">
               												<input class="form-control" type="file" id="imagen{{ $condominio->id }}" name="imagen" disabled >
               											</div>
               										</div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Dirección</label>
                                     <div class="col-sm-9">
                                       <textarea id="direccion{{ $condominio->id }}" class="form-control" name="direccion" disabled required>{{ $condominio->direccion }}</textarea>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label" for="card-number">Fecha</label>
                                     <div class="col-sm-9">
                                       <div class="input-group">
                                       <input id="fecha{{ $condominio->id }}" class="form-control datepicker" type="text" value="{{ $condominio->fecha }}" name="fecha" disabled required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                     </div>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label" for="card-number">Horario</label>
                                     <div class="col-sm-9">
                                       <div class="input-group bootstrap-timepicker timepicker">
                                         <input id="horario{{ $condominio->id }}" value="{{ $condominio->horario }}" class="form-control mitimepicker" type="text" name="horario" disabled required/><span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                       </div>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Instructor</label>
                                     <div class="col-sm-9">
                                       <select class="form-control"  name="coach" id="coach{{ $condominio->id }}" disabled required>
                                         <option value="">Selecciona una opción</option>
                                         @foreach ($coaches as $coach)
                                           <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                                         @endforeach
                                       </select>
                                       <script type="text/javascript">
                                         if (document.getElementById('coach{{ $condominio->id }}') != null) document.getElementById('coach{{ $condominio->id }}').value = '{!! $condominio->coach !!}';
                                       </script>
                                     </div>

                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Cupo</label>
                                     <div class="col-sm-9">
                                       <input type="text" id="cupo{{ $condominio->id }}" class="form-control" name="cupo" value="{{ $condominio->cupo }}" disabled required>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Precio</label>
                                     <div class="col-sm-9">
                                       <input type="text" id="precio{{ $condominio->id }}" class="form-control" name="precio" value="{{ $condominio->precio }}" disabled required>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Clase</label>
                                     <div class="col-sm-9">
                                       <select class="form-control"  name="clases_id" disabled id="clases_id{{ $condominio->id }}" required>
                                         <option value="">Selecciona una opción</option>
                                         @foreach ($clases as $clase)
                                           <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                                         @endforeach
                                       </select>
                                     </div>
                                   </div>
                                   <script type="text/javascript">
                                     if (document.getElementById('clases_id{{ $condominio->id }}') != null) document.getElementById('clases_id{{ $condominio->id }}').value = '{!! $condominio->clases_id !!}';
                                   </script>
               												{!! csrf_field() !!}
               												<div class="form-group">
               													<div class="col-sm-12 text-right">
               														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $condominio->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $condominio->id }}" onclick="habilitar({{ $condominio->id }})">Editar</a> &nbsp;
                                          @if (Auth::user()->role=="superadmin")
                                          <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $condominio->id }}').click();">Borrar</a>
                                          @endif
               													</div>
               												</div>
               									</form>
                                <form style="display: none;" action="{{ url('/eliminar-condominio') }}/{{ $condominio->id }}" method="post">
                                  {!! csrf_field() !!}
                                  <input type="submit" id="botoneliminar{{ $condominio->id }}">
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
             <p>No tienes eventos</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#condominios" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar evento
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="condominio">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-condominio') }}" method="post"  enctype="multipart/form-data">

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Identificador</label>
                         <div class="col-sm-9">
                           <input id="identificadorNuevo" class="form-control" type="text" value="{{ old('identificador') }}" name="identificador" required>
                         </div>
                       </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen</label>
                        <div class="col-sm-9">
                          <input class="form-control" id="imagenNuevo" type="file" name="imagen" required>
                        </div>
                      </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Dirección</label>
                         <div class="col-sm-9">
                           <textarea id="direccionNuevo" class="form-control" name="direccion" required>{{ old('direccion') }}</textarea>
                         </div>
                       </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha</label>
                        <div class="col-sm-9">
                          <div class="input-group">
                          <input class="form-control datepicker" type="text" value="{{ old('fecha') }}" name="fecha" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        </div>
                        </div>
                      </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Horario</label>
                         <div class="col-sm-9">
                           <div class="input-group bootstrap-timepicker timepicker">
                             <input id="horarioNuevo" value="{{ old('horario') }}" class="form-control mitimepicker" type="text" name="horario" required/><span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                           </div>

                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Instructor</label>
                         <div class="col-sm-9">
                           <select class="form-control"  name="coach" id="coachNuevo" required>
                             <option value="">Selecciona una opción</option>
                             @foreach ($coaches as $coach)
                               <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                             @endforeach
                           </select>
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Clase</label>
                         <div class="col-sm-9">
                           <select class="form-control"  name="clases_id" id="clases_idNuevo" required>
                             <option value="">Selecciona una opción</option>
                             @foreach ($clases as $clase)
                               <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                             @endforeach
                           </select>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Cupo</label>
                         <div class="col-sm-9">
                           <input type="num" id="cupoNuevo" class="form-control" name="cupo" value="{{ old('cupo') }}" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Precio</label>
                         <div class="col-sm-9">
                           <input type="text" id="precioNuevo" class="form-control" name="precio" value="{{ old('precio') }}" required>
                         </div>
                       </div>
                          {!! csrf_field() !!}
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

           <!--termina condominios -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('identificador'+valor).disabled=false;
    document.getElementById('direccion'+valor).disabled=false;
    document.getElementById('coach'+valor).disabled=false;
    document.getElementById('horario'+valor).disabled=false;
    document.getElementById('fecha'+valor).disabled=false;
    document.getElementById('cupo'+valor).disabled=false;
    document.getElementById('imagen'+valor).disabled=false;
    document.getElementById('precio'+valor).disabled=false;
    document.getElementById('clases_id'+valor).disabled=false;
    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>
<script type="text/javascript">
        $(document).ready(function () {
            $('.mitimepicker').timepicker();
        });
    </script>

@endsection
