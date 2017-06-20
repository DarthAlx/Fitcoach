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
			@include('content_holders.sidebar2', ['menu'=>'horariosmenu'])
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- horarios -->
              <h2>Tus horarios</h2>
              @if (!$user->horarios->isEmpty())
                   <div class="panel-group" id="horarios" role="tablist" aria-multiselectable="true">
                     @foreach ($user->horarios as $horario)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $horario->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#horarios" href="#collapse{{ $horario->id }}" aria-expanded="false" aria-controls="collapse{{ $horario->id }}">
                             <a role="button">
                               @foreach ($clases as $clase)
                                 @if ($clase->id==$horario->clases_id)
                                   {{ Ucfirst($clase->nombre) }} - {{ Ucfirst($horario->hora) }}
                                 @endif

                               @endforeach
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $horario->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $horario->id }}">
                           <div class="panel-body">
                             <div class="horario">
                               <div class="editar">
                                 <div class="col-md-12">
                                      <br/>
                                     <div class="form-horizontal">
                                 <form action="{{ url('/actualizar-horario') }}/{{ $horario->id }}" method="post">
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label">Clase</label>
                                     <div class="col-sm-9">
                                       <select class="form-control"  name="clases_id" disabled id="clases_id{{ $horario->id }}" required>
                                         <option value="">Selecciona una opción</option>
                                         @foreach ($clases as $clase)
                                           <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                                         @endforeach
                                       </select>
                                     </div>
                                   </div>
                                   <script type="text/javascript">
                                     if (document.getElementById('clases_id{{ $horario->id }}') != null) document.getElementById('clases_id{{ $horario->id }}').value = '{!! $horario->clases_id !!}';
                                   </script>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label" for="card-number">Fecha disponible</label>
                                     <div class="col-sm-9">
                                       <div class="input-group">
                                       <input id="fecha{{ $horario->id }}" class="form-control datepicker" type="text" value="{{ $horario->fecha }}" name="fecha" disabled required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                     </div>
                                     </div>
                                   </div>
                                    <div class="form-group">
                                      <label class="col-sm-3 control-label" for="card-number">Hora disponible</label>
                                      <div class="col-sm-9">
                                        <div class="input-group bootstrap-timepicker timepicker">
                                          <input id="hora{{ $horario->id }}" value="{{ $horario->hora }}" class="form-control mitimepicker" type="text" name="hora" disabled required/><span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        </div>

                                      </div>
                                    </div>
                                    <div class="form-group recurrente" >
                                       <label class="col-sm-3 control-label">Recurrencia</label>
                                       <div class="col-sm-9">
                                           <div class="checkbox">

                                              <label><input type='checkbox' class="recurrentes" id="check{{$user->id}}1" name="recurrencia[]"  value="1">L &nbsp;  &nbsp;  </label>
                                              <label><input type='checkbox' class="recurrentes" id="check{{$user->id}}2" name="recurrencia[]"  value="2">M &nbsp;  &nbsp;  </label>
                                              <label><input type='checkbox' class="recurrentes" id="check{{$user->id}}3" name="recurrencia[]"  value="3">M &nbsp;  &nbsp;  </label>
                                              <label><input type='checkbox' class="recurrentes" id="check{{$user->id}}4" name="recurrencia[]"  value="4">J &nbsp;  &nbsp;  </label>
                                              <label><input type='checkbox' class="recurrentes" id="check{{$user->id}}5" name="recurrencia[]"  value="5">V &nbsp;  &nbsp;  </label>
                                              <label><input type='checkbox' class="recurrentes" id="check{{$user->id}}6" name="recurrencia[]"  value="6">S &nbsp;  &nbsp;  </label>
                                              <label><input type='checkbox' class="recurrentes" id="check{{$user->id}}7" name="recurrencia[]"  value="7">D &nbsp;  &nbsp;  </label>

                                           </div>
                                       </div>
                                     </div>
                                     <?php
                                          $recurrencias = explode(",",$horario->recurrencia);
                                      ?>
                                     <script type="text/javascript">
                                       @foreach ($recurrencias as $recurrencia)
                                         document.getElementById('check{{$user->id}}{{$recurrencia}}').checked = true;
                                       @endforeach
                                     </script>


               												{!! csrf_field() !!}
               												<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
               												<div class="form-group">
               													<div class="col-sm-12 text-right">
               														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $horario->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $horario->id }}" onclick="habilitar({{ $horario->id }})">Editar</a> &nbsp;

                                          <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $horario->id }}').click();">Borrar</a>
               													</div>
               												</div>
               									</form>
                                <form style="display: none;" action="{{ url('/eliminar-horario') }}/{{ $horario->id }}" method="post">
                                  {!! csrf_field() !!}
                                  <input type="submit" id="botoneliminar{{ $horario->id }}">
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
             <p>No tienes horarios</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#horarios" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar horario
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="horario">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-horario') }}" method="post">

                         <div class="form-group">
                           <label class="col-sm-3 control-label">Clase</label>
                           <div class="col-sm-9">
                             <select class="form-control"  name="clases_id" id="claseNuevo" required>
                               <option value="">Selecciona una opción</option>
                               @foreach ($clases as $clase)
                                 <option value="{{ $clase->id }}">{{ $clase->nombre }}</option>
                               @endforeach
                             </select>
                           </div>
                         </div>
                         <div class="form-group">
     											<label class="col-sm-3 control-label" for="card-number">Fecha disponible</label>
     											<div class="col-sm-9">
     												<div class="input-group">
     												<input class="form-control datepicker" type="text" value="{{ old('fecha') }}" name="fecha" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
     											</div>
     											</div>
     										</div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Hora disponible</label>
                            <div class="col-sm-9">
                              <div class="input-group bootstrap-timepicker timepicker">
                                <input id="horaNuevo" value="{{ old('hora') }}" class="form-control mitimepicker" type="text" name="hora" required/><span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                              </div>

                            </div>
                          </div>

                          <div class="form-group recurrente" >
                             <label class="col-sm-3 control-label">Recurrencia</label>
                             <div class="col-sm-9">
                                 <div class="checkbox">

                                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="1">L &nbsp;  &nbsp;  </label>
                                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="2">M &nbsp;  &nbsp;  </label>
                                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="3">M &nbsp;  &nbsp;  </label>
                                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="4">J &nbsp;  &nbsp;  </label>
                                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="5">V &nbsp;  &nbsp;  </label>
                                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="6">S &nbsp;  &nbsp;  </label>
                                    <label><input type='checkbox' class="recurrentes" name="recurrencia[]"  value="7">D &nbsp;  &nbsp;  </label>

                                 </div>
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

           <!--termina horarios -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('clases_id'+valor).disabled=false;
    document.getElementById('fecha'+valor).disabled=false;
    document.getElementById('hora'+valor).disabled=false;
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
