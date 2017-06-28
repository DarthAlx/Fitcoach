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

	                                    <input class="form-control" id="numtarjeta" placeholder="Número de tarjeta" autocomplete="off"  data-conekta="card[number]" type="text" required> </div>
	                            </div>
	                            <div class="form-group row">
	                                <div class="col-sm-5 col-xs-12">
	                                    <input class="form-control" id="nombretitular" placeholder="Nombre del titular" autocomplete="off" data-conekta="card[name]"  type="text" required> </div>
	                                <div class="col-sm-2 col-xs-3">
	                                    <input class="form-control" id="mm" placeholder="MM" data-conekta="card[exp_month]" type="text" required> </div>
	                                <div class="col-sm-2 col-xs-3">
	                                    <input class="form-control" id="aa" placeholder="AA"  data-conekta="card[exp_year]" type="text" required> </div>
	                                <div class="col-sm-3 col-xs-6">
	                                    <div class="input-group">
	                                        <input class="form-control" id="cvv" placeholder="CVV" autocomplete="off"  data-conekta="card[cvc]" type="text" required> <span class="input-group-btn"> <button type="button" class="btn btn-default" data-toggle="popover" data-container="body" data-placement="top" data-content="Código de seguridad de 3 dígitos ubicado normalmente en la parte trasera de su tarjeta. Las tarjetas American Express tienen un código de 4 dígitos ubicado en el frente.">?</button> </span>                                        </div>
	                                </div>
	                            </div>
															<input type="text" name="conektaid" value="cus_2gmNZviLrDwnqjjDf">
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
		</script>


@endsection
