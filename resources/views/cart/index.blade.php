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
			<div class="col-md-6">
				<h1>carrito</h1>
				<ol>
					@foreach ($items as $item)
						<li>{{ $item->name}}</li>
					@endforeach
				</ol>

			</div>
			<div class="col-md-6">

			</div>
		</div>



		</section>


@endsection
