@extends('plantilla')
@section('pagecontent')

	<section class="container-bootstrap">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="row">
			<div class="col-xs-12">
				@include('content_holders.notificaciones')
			</div>
		</div>
	</section>



		<div class="container-bootstrap">
			<div class="row">
				@if (Cart::content()->count()<=0)
					<div class="col-xs-12">
						<div class="well">
							<h3>Su carrito de compras está vacio. <a href="{{url('/clasesdeportivas')}}">Continuar comprando.</a></h3>
						</div>
					</div>
				@else
				<div class="col-xs-12">
					<div class="panel panel-warning" style="border-color: rgba(213, 134, 40, 0.64) !important;">
						<div class="panel-heading"  style="color: #fff !important; background-color: rgba(213, 134, 40, 0.64) !important; border-color: rgba(213, 134, 40, 0.64) !important;">
							<div class="panel-title">
								<div class="row">
									<div class="col-xs-6">
										<h5><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> Carrito de compras</h5>
									</div>
									<div class="col-xs-6">
										<a href="{{url('/clasesdeportivas')}}" class="btn btn-default btn-sm pull-right">
											<i class="fa fa-share fa-lg" aria-hidden="true"></i> Continuar comprando
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-body">

							@foreach ($items as $product)
							<div class="row">
								<div class="col-xs-2"><img class="img-responsive" src="http://placehold.it/100x70">
								</div>
								<div class="col-xs-4">
									<h4 class="product-name"><strong>{{ $product->name }}</strong></h4>

									@if ($product->options->tipo=="particular")
										<h4><small>
											Fecha: {{ $product->options->fecha }}<br>
											<?php $horario=App\Horarios::find($product->options->horario); ?>
											Horario: {{ $horario->hora }}<br>
											<?php $coach=App\User::find($horario->user_id); ?>
											Coach: {{ $coach->name }}<br>
											<?php $direccion=App\Direcciones::find($product->options->direccion); ?>

											Dirección: {{ $direccion->identificador }}<br>
										</small></h4>
									@endif
									@if ($product->options->tipo=="fitcoach")

										<h4><small>
											<?php $zona=App\Zona::find($product->options->zona); ?>
											<?php $clase=App\Clases::find($zona->clases_id); ?>
											<?php $coach=App\User::find($zona->coach); ?>

											Fecha: {{ $zona->fecha }}<br>
											Clase: {{ $clase->nombre }}<br>
											Coach: {{ $coach->name }}<br>
											Dirección: {{ $zona->direccion }}<br>
											Horario: {{ $zona->horario }}<br>
										</small></h4>
									@endif
								</div>
								<div class="col-xs-6">
									<div class="col-xs-10 text-right">
										<h6><strong>{{ $product->price}} <span class="text-muted"></span></strong></h6>
									</div>
									<!--div class="col-xs-4">
										<input type="text" class="form-control input-sm" id="qty{{ $product->id }}" onblur="cantidad()" value="{{ $product->qty }}">
									</div-->
									<div class="col-xs-2">
										<a href="{{url('removefromcart')}}/{{$product->rowId}}" class="btn btn-link btn-xs">
											<i class="fa fa-trash fa-lg" aria-hidden="true"></i> </span>
										</a>
									</div>
								</div>
							</div>
							<hr>
							<script type="text/javascript">
							function cantidad(){
								if (document.getElementById('qty{{ $product->id }}').value!={{$product->qty}}) {
									window.location.href = "{{url('updatecart')}}/{{$product->rowId}}/"+document.getElementById('qty{{ $product->id }}').value;
								}
							}

							</script>
							@endforeach
							<hr>
							<!--div class="row">
								<div class="text-center">
									<div class="col-xs-9">
										<h6 class="text-right">Added items?</h6>
									</div>
									<div class="col-xs-3">
										<button type="button" class="btn btn-default btn-sm">
											Update cart
										</button>
									</div>
								</div>
							</div-->
						</div>
						<div class="panel-footer">
							<div class="row text-center">
								<div class="col-xs-12">
									<h4 class="text-right">Total <strong>${{Cart::total()}}</strong></h4>
								</div>

							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>

@if (Cart::content()->count()>0)
		<div class="container-bootstrap">
			<div class="row">
				<div class="col-md-6">
					<div class="panel panel-default">
	                    <div class="panel-heading" role="tab" id="headingTwo">
	                        <h4 class="panel-title">

	                           Tarjetas de crédito o débito

	                        <span style="float: right"> <i class="fa fa-cc-visa" style="font-size: 24px;">&nbsp;</i> <i class="fa fa-cc-mastercard" style="font-size: 24px;">&nbsp;</i> <i class="fa fa-cc-amex" style="font-size: 24px;">&nbsp;</i></span> </h4>
	                      </div>
	                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
	                        <div class="panel-body">
														<form action="{{url('cargo')}}" method="POST" id="card-form">
															{{ csrf_field()}}
	                            <div class="form-group row">
	                                <div class="col-xs-12">

	                                    <input class="form-control" id="numtarjeta"  name="numero" placeholder="Número de tarjeta" autocomplete="off"  data-conekta="card[number]" type="text" required> </div>
	                            </div>
	                            <div class="form-group row">
	                                <div class="col-sm-5 col-xs-12">
	                                    <input class="form-control" id="nombretitular"  name="nombre" placeholder="Nombre del titular" autocomplete="off" data-conekta="card[name]"  type="text" required> </div>
	                                <div class="col-sm-2 col-xs-3">
	                                    <input class="form-control" id="mm" placeholder="MM" name="mes" data-conekta="card[exp_month]" type="text" required> </div>
	                                <div class="col-sm-2 col-xs-3">
	                                    <input class="form-control" id="aa" placeholder="AA" name="año"  data-conekta="card[exp_year]" type="text" required> </div>
	                                <div class="col-sm-3 col-xs-6">
	                                    <div class="input-group">
	                                        <input class="form-control" id="cvv" placeholder="CVV" autocomplete="off"  data-conekta="card[cvc]" type="text" required> <span class="input-group-btn"> <button type="button" class="btn btn-default" data-toggle="popover" data-container="body" data-placement="top" data-content="Código de seguridad de 3 dígitos ubicado normalmente en la parte trasera de su tarjeta. Las tarjetas American Express tienen un código de 4 dígitos ubicado en el frente.">?</button> </span>
																				</div>
	                                </div>
	                            </div>
															<div class="form-group row">
	                                <div class="col-xs-12">
																		<div class="checkbox">
															        <label>
															          <input name="guardartarjeta" value="si" type="checkbox" id="guardartarjeta"> Guardar tarjeta
															        </label>
															      </div>
	                              </div>
	                            </div>
															<div class="form-group row" id="identificadorcont" style="display: none;">
																<div class="col-xs-12">
																	<label>Identificador:</label>
																</div>
	                                <div class="col-xs-12">
																		<input type="text" name="identificador" class="form-control" placeholder="Ej: Crédito, Mi tarjeta, Banco ..." id="identificador">
	                              </div>
	                            </div>
															<input type="hidden" name="name" value="{{$user->name}}">
															<input type="hidden" name="email" value="{{$user->email}}">
															<input type="hidden" name="phone" value="{{$user->detalles->tel}}">
															<input type="hidden" name="user_id" value="{{$user->id}}">

															<div class="form-group row">
	                                <div class="col-xs-12">
																		<button class="btn btn-primary pull-right" type="submit">Pagar</button>
	                                </div>
	                            </div>

															</form>

	                        </div>
	                    </div>
	                </div>
				</div>

			</div>
		</div>
	@endif





		<script type="text/javascript" >
		  Conekta.setPublishableKey('key_ExsfYxwMz4KMdE5PTfN6B6g');

		  var conektaSuccessResponseHandler = function(token) {
		    var $form = $("#card-form");
		    //Inserta el token_id en la forma para que se envíe al servidor
		    $form.append($('<input type="hidden" name="tokencard" id="conektaTokenId">').val(token.id));
		    $form.get(0).submit(); //Hace submit
		  };
		  var conektaErrorResponseHandler = function(response) {
		    var $form = $("#card-form");
				$("#cart-errors").show();
		    $(".card-errors").text(response.message_to_purchaser);
		    $form.find("button").prop("disabled", false);
		  };

		  //jQuery para que genere el token después de dar click en submit
		  $(function () {
		    $("#card-form").submit(function(event) {
		      var $form = $(this);
		      // Previene hacer submit más de una vez
		      $form.find("button").prop("disabled", true);
		      Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
		      return false;
		    });
		  });

			$(document).ready(function() {
			        $('[data-toggle="popover"]').popover();
			    });

						$("#guardartarjeta").click( function(){
						   if( $(this).is(':checked') ){
								 $('#identificadorcont').show();
								 $("#identificador").attr("required", true);
							 }
							 else {
							 	$('#identificadorcont').hide();
								$("#identificador").attr("required", false);
							 }
						});

		</script>
@endsection
