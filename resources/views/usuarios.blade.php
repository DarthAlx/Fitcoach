@extends('plantilla')
@section('pagecontent')
  @include('content_holders.auth', ['role'=>'superadmin'])
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
			@include('content_holders.sidebar3')
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- usuarios -->
              <h2>Usuarios</h2>
              @if (!$usuarios->isEmpty())
                   <div class="panel-group" id="usuarios" role="tablist" aria-multiselectable="true">
                     <form role="form" action="{{ url('/buscar-usuario') }}" method="post">
                       <div class="row">
                         <div class="col-sm-6 col-sm-offset-6">
                           {!! csrf_field() !!}
                         <div class="input-group">
                            <input type="text" class="form-control" name="buscar" placeholder="Palabras clave...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="submit">Buscar</button>
                            </span>
                          </div>
                          </div>
                       </div>

                     </form>
                     <p>&nbsp;</p>
                     @foreach ($usuarios as $usuario)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $usuario->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#usuarios" href="#collapse{{ $usuario->id }}" aria-expanded="false" aria-controls="collapse{{ $usuario->id }}">
                             <a role="button">
                                   {{ Ucfirst($usuario->id) }} - {{ Ucfirst($usuario->name) }} - {{ $usuario->email }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $usuario->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $usuario->id }}">
                           <div class="panel-body">
                             <div class="usuario">
                               <div class="editar">
                                 <div class="col-md-12">

                                    <form id="signupform" class="form-horizontal" role="form" action="{{ url('/actualizar-usuario') }}/{{ $usuario->id }}" method="post">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <div class="form-group">
                                          <label for="name" class="col-sm-3 control-label">Nombre</label>
                                          <div class="col-sm-9">
                                              <input type="text" class="form-control" name="name" value="{{ $usuario->name }}" id="name{{ $usuario->id }}" disabled placeholder="Nombre" required>
                                          </div>
                                      </div>
                                        <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Correo electrónico</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" value="{{ $usuario->email }}" id="email{{ $usuario->id }}" disabled placeholder="tu@email.com" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                 													<label class="col-sm-3 control-label">Rol</label>
                 													<div class="col-sm-9">
                 														<select class="form-control rol{{ $usuario->id }}" disabled name="role" id="role{{ $usuario->id }}" required>
                 															<option value="">Selecciona una opción</option>
                 															<option value="usuario">Usuario</option>
                 															<option value="instructor">Instructor</option>
                                              <option value="admin">Admin</option>
                 															<option value="superadmin">Superadmin</option>
                 														</select>
                                            <script type="text/javascript">
                                              if (document.getElementById('role{{ $usuario->id }}') != null) document.getElementById('role{{ $usuario->id }}').value = '{!! $usuario->role !!}';
                                            </script>
                 													</div>
                 												</div>
                                        <script type="text/javascript">
                                           $(function() {
                                               @if ($usuario->role=="instructor")
                                                     $('.permitidascont{{ $usuario->id }}').show();
                                               @else
                                                     $('.permitidascont{{ $usuario->id }}').hide();
                                               @endif
                                           });
                                       </script>
                                       @if ($usuario->role=="instructor")
                                        <div class="form-group permitidascont{{ $usuario->id }}" style="">
                                          <label class="col-sm-3 control-label">Clases permitidas</label>
                                          <div class="col-sm-9">

                                            <?php
                                              $clasespermitidas = explode(',',$usuario->clases);
                                             ?>
                                               @foreach ($clases as $clase)
                                                   <div class="checkbox">
                                                    <label>
                                                      <input type='checkbox' name="clases[]" id="check{{$usuario->id}}{{$clase->id}}" value="{{$clase->id}}">{{ $clase->nombre }}
                                                    </label>
                                                   </div>
                                               @endforeach
                                          </div>
                                        </div>
                                        <script type="text/javascript">
                                          @foreach ($clasespermitidas as $clasepermitida)

                                            document.getElementById('check{{$usuario->id}}{{$clasepermitida}}').checked = true;
                                          @endforeach
                                        </script>

                                        @endif



                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Contraseña</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password" id="password{{ $usuario->id }}" disabled placeholder="Contraseña">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Repetir contraseña</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation{{ $usuario->id }}" disabled placeholder="Repetir contraseña" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                 													<div class="col-sm-12 text-right">
                 														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $usuario->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $usuario->id }}" onclick="habilitar({{ $usuario->id }})">Editar</a> &nbsp;

                                            <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $usuario->id }}').click();">Borrar</a>
                 													</div>
                 												</div>



                                    </form>
                                    <form style="display: none;" action="{{ url('/eliminar-usuario') }}/{{ $usuario->id }}" method="post">
                                      {!! csrf_field() !!}
                                      <input type="submit" id="botoneliminar{{ $usuario->id }}">
                                    </form>

                          </div>
                               </div>

                             </div>
                             <!-- detalles usuario-->
                             @if ($usuario->role=="usuario")
                               @if ($usuario->detalles)
                                 <a  role="button" data-toggle="collapse" href="#detalles{{ $usuario->id }}" aria-expanded="false" aria-controls="detalles{{ $usuario->id }}">
                                   Detalles <span class="caret"></span>
                                 </a>
                                 <div class="collapse" id="detalles{{ $usuario->id }}">
                                   <?php
                                   $tz  = new DateTimeZone('America/Mexico_City');
                                  $age = DateTime::createFromFormat('d-m-Y', $usuario->detalles->dob, $tz)->diff(new DateTime('now', $tz))->y;
                                  ?>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <tr>
                                        <th>Edad</th>
                                        <th>Teléfono</th>
                                        <th>Intereses</th>
                                      </tr>
                                      <tr>
                                        <td>{{ $age }}</td>
                                        <td>{{ $usuario->detalles->tel }}</td>
                                        <td>{{ $usuario->detalles->intereses }}</td>
                                      </tr>

                                    </table>
                                  </div>
                                  @if (!$usuario->direcciones->isEmpty())
                                    <ul class="list-group">
                                      @foreach ($usuario->direcciones as $direccion)
                                        <li class="list-group-item">
                                          <strong>{{ $direccion->identificador }}</strong><br>
                                          {{ $direccion->calle }} {{ $direccion->numero_ext }} {{ $direccion->numero_int }}<br>
                                          {{ $direccion->colonia }},  {{ $direccion->municipio_del }}<br>
                                           {{ $direccion->cp }},  {{ $direccion->estado }}, Méx.
                                        </li>
                                      @endforeach
                                    </ul>

                                  @endif
                                  </div>
                             @endif


                             @endif
                             <!-- termina detalles usuario-->

                              <!-- detalles instructor-->
                             @if ($usuario->role=="instructor")
                               @if ($usuario->detalles_instructor)
                                 <a  role="button" data-toggle="collapse" href="#detalles{{ $usuario->id }}" aria-expanded="false" aria-controls="detalles{{ $usuario->id }}">
                                   Detalles <span class="caret"></span>
                                 </a>
                                 <div class="collapse" id="detalles{{ $usuario->id }}">
                                   <?php
                                   $tz  = new DateTimeZone('America/Mexico_City');
                                  $age = DateTime::createFromFormat('d-m-Y', $usuario->detalles_instructor->dob, $tz)->diff(new DateTime('now', $tz))->y;
                                  ?>
                                  <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                      <tr>
                                        <th>RFC</th>
                                        <th>Edad</th>
                                        <th>Teléfono</th>

                                      </tr>
                                      <tr>
                                        <td>{{ $usuario->detalles_instructor->rfc }}</td>
                                        <td>{{ $age }}</td>
                                        <td>{{ $usuario->detalles_instructor->tel }}</td>

                                      </tr>

                                    </table>
                                  </div>
                                  @if (!$usuario->vehiculos->isEmpty())
                                    <ul class="list-group">
                                      @foreach ($usuario->vehiculos as $vehiculo)
                                        <li class="list-group-item">
                                          <strong>{{ $vehiculo->identificador}} - {{ $vehiculo->placa}}</strong><br>
                                          {{ $vehiculo->tipo }}, {{ $vehiculo->modelo }}, {{ $vehiculo->color }}
                                        </li>
                                      @endforeach
                                    </ul>

                                  @endif
                                  </div>
                             @endif


                             @endif
                             <!-- termina detalles instructor-->


                           </div>
                         </div>
                       </div>

                     @endforeach
                     <div class="text-left">
                       {!! $usuarios->render() !!}
                     </div>

                   </div>

           @else
             <p>No hay usuarios</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#usuarios" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar usuario
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="usuario">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-usuario') }}" method="post"  enctype="multipart/form-data">

                       <div class="form-group">
                           <label for="name" class="col-sm-3 control-label">Nombre</label>
                           <div class="col-sm-9">
                               <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nombre" required>
                           </div>
                       </div>
                         <div class="form-group">
                             <label for="email" class="col-sm-3 control-label">Correo electrónico</label>
                             <div class="col-sm-9">
                                 <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="tu@email.com" required>
                             </div>
                         </div>
                         <div class="form-group">
                           <label class="col-sm-3 control-label">Rol</label>
                           <div class="col-sm-9">
                             <select class="form-control rol" name="role" id="roleNuevo" required>
                               <option value="">Selecciona una opción</option>
                               <option value="usuario">Usuario</option>
                               <option value="instructor">Instructor</option>
                               <option value="admin">Admin</option>
                               <option value="superadmin">Superadmin</option>
                             </select>
                           </div>
                         </div>
                         <script type="text/javascript">
                            $(function() {
                                $('.rol').on('change', function() {
                                    var valor = $('.rol').val();
                                    if (valor=="instructor") {
                                      $('.permitidascont').show();
                                      

                                    }
                                    else {
                                      $('.permitidascont').hide();
                                      
                                    }
                                });
                            });
                        </script>

                         <div class="form-group permitidascont" style="display:none">
                           <label class="col-sm-3 control-label">Clases permitidas</label>
                           <div class="col-sm-9">
                             @foreach ($clases as $clase)
                               <div class="checkbox">
                                <label>
                                  <input type='checkbox' class="permitidas" name="clases[]"  value="{{$clase->id}}">{{ $clase->nombre }}
                                </label>
                               </div>

                             @endforeach
                           </div>
                         </div>


                         

                         <div class="form-group">
                             <label for="password" class="col-sm-3 control-label">Contraseña</label>
                             <div class="col-sm-9">
                                 <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                             </div>
                         </div>
                         <div class="form-group">
                             <label for="password" class="col-sm-3 control-label">Repetir contraseña</label>
                             <div class="col-sm-9">
                                 <input type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña" required>
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

           <!--termina usuarios -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('name'+valor).disabled=false;
    document.getElementById('email'+valor).disabled=false;
    document.getElementById('role'+valor).disabled=false;
    document.getElementById('password'+valor).disabled=false;
    document.getElementById('password_confirmation'+valor).disabled=false;
    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>

@endsection
