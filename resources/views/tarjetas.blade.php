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
			@include('content_holders.sidebar', ['menu'=>'tarjetasmenu'])
		</div>
		<div class="col-md-9">
            <div class="profile-content">
              <!-- tarjetas -->
              <h2>Tus tarjetas</h2>
              @if (!$user->tarjetas->isEmpty())
                   <div class="panel-group" id="tarjetas" role="tablist" aria-multiselectable="true">
                     @foreach ($user->tarjetas as $tarjeta)
                       <div class="panel panel-default">
                         <div class="panel-heading" role="tab" id="heading{{ $tarjeta->id }}">
                           <h4 class="panel-title" data-toggle="collapse" data-parent="#tarjetas" href="#collapse{{ $tarjeta->id }}" aria-expanded="false" aria-controls="collapse{{ $tarjeta->id }}">
                             <a role="button">
                               {{ Ucfirst($tarjeta->identificador) }}
                             </a>
                           </h4>
                         </div>
                         <div id="collapse{{ $tarjeta->id }}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{ $tarjeta->id }}">
                           <div class="panel-body">
                             <div class="tarjeta">
                               <div class="editar">
                                 <div class="col-md-12">
                                      <br/>
                                     <div class="form-horizontal">
                                 <form action="{{ url('/actualizar-tarjeta') }}/{{ $tarjeta->id }}" method="post">

                                   <div class="form-group">
                                     <label class="col-sm-3 control-label" for="card-number">Identificador</label>
                                     <div class="col-sm-9">
                                       <input class="form-control" type="text" value="{{ Ucfirst($tarjeta->identificador) }}" id="identificador{{ $tarjeta->id }}" name="identificador" disabled placeholder="Ej: Crédito, Mi tarjeta, Banco ..." required>
                                     </div>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label" for="card-holder-name">Tarjeta</label>
                                     <div class="col-sm-5">
                                       <input class="form-control" type="num" value="{{ Ucfirst($tarjeta->num) }}" id="num{{ $tarjeta->id }}" name="num" placeholder="No. de tarjeta" disabled required>
                                     </div>
                                     <div class="col-sm-2">
                                       <select class="form-control" id="mes{{ $tarjeta->id }}" name="mes" disabled required>
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
                                     <script type="text/javascript">
                                       if (document.getElementById('mes{{ $tarjeta->id }}') != null) document.getElementById('mes{{ $tarjeta->id }}').value = '{!! $tarjeta->mes !!}';
                                     </script>
                                     <div class="col-sm-2">
                                       <select class="form-control" id="año{{ $tarjeta->id }}" name="año" disabled required>
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
                                     <script type="text/javascript">
                                       if (document.getElementById('año{{ $tarjeta->id }}') != null) document.getElementById('año{{ $tarjeta->id }}').value = '{!! $tarjeta->año !!}';
                                     </script>
                                   </div>
                                   <div class="form-group">
                                     <label class="col-sm-3 control-label" for="card-number">Nombre del titular</label>
                                     <div class="col-sm-9">
                                       <input class="form-control" type="text" value="{{ Ucfirst($tarjeta->nombre) }}" id="nombre{{ $tarjeta->id }}" name="nombre" disabled required>
                                     </div>
                                   </div>
               												{!! csrf_field() !!}
               												<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
               												<div class="form-group">
               													<div class="col-sm-12 text-right">
               														<input class="btn btn-success" type="submit" value="Guardar" style="display: none" id="botonguardar{{ $tarjeta->id }}"><a href="#" class="btn btn-primary"  id="botoneditar{{ $tarjeta->id }}" onclick="habilitar({{ $tarjeta->id }})">Editar</a> &nbsp;

                                          <a href="#" class="btn btn-danger" onclick="javascript: document.getElementById('botoneliminar{{ $tarjeta->id }}').click();">Borrar</a>
               													</div>
               												</div>
               									</form>
                                <form style="display: none;" action="{{ url('/eliminar-tarjeta') }}/{{ $tarjeta->id }}" method="post">
                                  {!! csrf_field() !!}
                                  <input type="submit" id="botoneliminar{{ $tarjeta->id }}">
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
             <p>No tienes tarjetas</p>
           @endif
           <div class="panel panel-default">
             <div class="panel-heading" role="tab" id="headingNuevo">
               <h4 class="panel-title" data-toggle="collapse" data-parent="#tarjetas" href="#collapseNuevo" aria-expanded="false" aria-controls="collapseNuevo">
                 <a role="button">
                   Agregar tarjeta
                 </a>
               </h4>
             </div>
             <div id="collapseNuevo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNuevo">
               <div class="panel-body">
                 <div class="tarjeta">
                   <div class="editar">
                     <div class="col-md-12">
                          <br/>
                         <div class="form-horizontal">
                     <form action="{{ url('/agregar-tarjeta') }}" method="post">
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

           <!--termina tarjetas -->


            </div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function habilitar(valor){
    document.getElementById('identificador'+valor).disabled=false;
    document.getElementById('num'+valor).disabled=false;
    document.getElementById('mes'+valor).disabled=false;
    document.getElementById('año'+valor).disabled=false;
    document.getElementById('nombre'+valor).disabled=false;
    document.getElementById('botonguardar'+valor).style.display="inline-block";
    document.getElementById('botoneditar'+valor).style.display="none";
  }
</script>
@endsection
