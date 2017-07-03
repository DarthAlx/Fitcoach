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
			@include('content_holders.sidebar3', ['menu'=>'clasesmenu'])
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- clases -->
              <h2>Clases</h2>
              @if (!$clases->isEmpty())
                   <div class="panel-group" id="clases" role="tablist" aria-multiselectable="true">
                     @foreach ($clases as $clase)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $clase->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#clases" href="#collapse{{ $clase->id }}" aria-expanded="false" aria-controls="collapse{{ $clase->id }}">
                             <a role="button">
                                   {{ Ucfirst($clase->nombre) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $clase->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $clase->id }}">
                           <div class="panel-body">
                             <div class="clase">
                               <div class="editar">
                                 <div class="col-md-12">
                                      <br/>
                                     <div class="form-horizontal">
                                 <form action="{{ url('/actualizar-clase') }}/{{ $clase->id }}" method="post"  enctype="multipart/form-data">
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Nombre</label>
                                     <div class="col-sm-9">
                                       <input id="nombre{{ $clase->id }}" class="form-control" type="text" value="{{ $clase->nombre }}" name="nombre" disabled required>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Tipo</label>
                                     <div class="col-sm-9">
                                       <select class="form-control"  name="tipo" disabled id="tipo{{ $clase->id }}" required>
                                         <option value="">Selecciona una opción</option>
                                           <option value="Deportiva">Deportiva</option>
                                           <option value="Cultural">Cultural</option>
                                       </select>
                                     </div>
                                   </div>
                                   <script type="text/javascript">
                                     if (document.getElementById('tipo{{ $clase->id }}') != null) document.getElementById('tipo{{ $clase->id }}').value = '{!! $clase->tipo !!}';
                                   </script>
                                   <div class="form-group">
               											<label class="col-sm-3 control-label">Imagen (solo si se desea reemplazar)</label>
               											<div class="col-sm-9">
               												<input class="form-control" type="file" id="imagen{{ $clase->id }}" name="imagen" disabled >
               											</div>
               										</div>
                                  <div class="form-group">
                                    <label class="col-sm-3 control-label">Descripción</label>
                                    <div class="col-sm-9">
                                      <textarea id="descripcion{{ $clase->id }}" class="form-control" name="descripcion" disabled required>{{ $clase->descripcion }}</textarea>
                                    </div>
                                  </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Precio</label>
                                     <div class="col-sm-9">
                                       <input id="precio{{ $clase->id }}" class="form-control" type="text" value="{{ $clase->precio }}" name="precio" disabled required>
                                     </div>
                                   </div>

                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Precio especial</label>
                                     <div class="col-sm-9">
                                       <input id="precio_especial{{ $clase->id }}" class="form-control" type="text" value="{{ $clase->precio_especial }}" name="precio_especial" disabled>
                                     </div>
                                   </div>
               												{!! csrf_field() !!}
               												<div class="form-group">
               													<div class="col-sm-12 text-right">
               														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $clase->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $clase->id }}" onclick="habilitar({{ $clase->id }})">Editar</a> &nbsp;

                                          @if (Auth::user()->role=="superadmin")
                                            <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $clase->id }}').click();">Borrar</a>
                                          @endif
               													</div>
               												</div>
               									</form>
                                <form style="display: none;" action="{{ url('/eliminar-clase') }}/{{ $clase->id }}" method="post">
                                  {!! csrf_field() !!}
                                  <input type="submit" id="botoneliminar{{ $clase->id }}">
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
             <p>No tienes clases</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#clases" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar clase
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="clase">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-clase') }}" method="post"  enctype="multipart/form-data">

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Nombre</label>
                         <div class="col-sm-9">
                           <input id="nombreNuevo" class="form-control" type="text" value="{{ old('nombre') }}" name="nombre" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Tipo</label>
                         <div class="col-sm-9">
                           <select class="form-control"  name="tipo"id="tipoNuevo" required>
                             <option value="">Selecciona una opción</option>
                               <option value="Deportiva">Deportiva</option>
                               <option value="Cultural">Cultural</option>
                           </select>
                         </div>
                       </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Imagen</label>
                        <div class="col-sm-9">
                          <input class="form-control" id="imagenNuevo" type="file" name="imagen" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label">Descripción</label>
                        <div class="col-sm-9">
                          <textarea id="precioNuevo" class="form-control" name="descripcion" required>{{ old('descripcion') }}</textarea>
                        </div>
                      </div>
                       <div class="form-group">
                         <label class="col-sm-3 control-label">Precio</label>
                         <div class="col-sm-9">
                           <input id="precioNuevo" class="form-control" type="text" value="{{ old('precio') }}" name="precio" required>
                         </div>
                       </div>

                       <div class="form-group">
                         <label class="col-sm-3 control-label">Precio especial</label>
                         <div class="col-sm-9">
                           <input id="precio_especialNuevo" class="form-control" type="text" value="{{ old('precio_especial') }}" name="precio_especial">
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

           <!--termina clases -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('nombre'+valor).disabled=false;
    document.getElementById('tipo'+valor).disabled=false;
    document.getElementById('imagen'+valor).disabled=false;
    document.getElementById('descripcion'+valor).disabled=false;
    document.getElementById('precio'+valor).disabled=false;
    document.getElementById('precio_especial'+valor).disabled=false;
    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>

@endsection
