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
							<h3>Su carrito de compras está vacio.</h3>
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
									<h4 class="product-name"><strong>{{ $product->name }}</strong></h4><h4><small>{{ $product->name }}</small></h4>
								</div>
								<div class="col-xs-6">
									<div class="col-xs-6 text-right">
										<h6><strong>{{ $product->price}} <span class="text-muted">x</span></strong></h6>
									</div>
									<div class="col-xs-4">
										<input type="text" class="form-control input-sm" id="qty{{ $product->id }}" onblur="cantidad()" value="{{ $product->qty }}">
									</div>
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
								<div class="col-xs-9">
									<h4 class="text-right">Total <strong>${{Cart::total()}}</strong></h4>
								</div>
								<div class="col-xs-3">
									<a href="#" class="btn btn-success pull-right">
										Pagar
									</a>
								</div>
							</div>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>


@endsection
