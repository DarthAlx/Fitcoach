@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="homeBxSliderWrap">
			<div class="homeBxSlider">


                <div class="slide" data-slide="0" style="background-image: url(./images/content/bg-clases.jpg);">

                    <div class="slideDesc">
                   <h3 style="color: #">clases a domicilio <br><a class="learnMore" href="#D58628">PROXIMAMENTE</a></h3>
						</div>
				</div>

				</div>

			</div>
			@include('content_holders.notificaciones')

		</div>
@endsection
