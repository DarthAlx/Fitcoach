@extends('plantilla')
@section('pagecontent')

	<section class="container">
		<div class="topclear">
	    &nbsp;
	  </div>
		<div class="row">
			<div class="col-xs-12">
				@include('content_holders.notificaciones')
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-2">
				<div class="product_large">
					<h1>{{$clase->identificador}}</h1>


					<h3 class="precio" id="precio">${{$clase->precio}}</h3>
					<form action="{{ url('/addtocart') }}" method="post">

					</form>
						<p>&nbsp;</p>
				</div>
			</div>

		</div>



		</section>


@endsection
