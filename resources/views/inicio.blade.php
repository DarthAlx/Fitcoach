@extends('plantilla')
@section('pagecontent')
	<section class="container">
		<div class="homeBxSliderWrap">
			<div class="homeBxSlider">
				@foreach ($sliders as $slider)
					<div class="slide" data-slide="{{ $slider->id-1	}}" style="background-image: url({{ url('images/content/')}}/{{ $slider->image	}});">

							<div class="slideDesc">
						 		{!! $slider->description !!}
					 		</div>
					</div>
				@endforeach


				</div>

			</div>
			@include('content_holders.notificaciones')

		</div>
@endsection
