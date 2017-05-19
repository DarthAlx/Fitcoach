@extends('plantilla')

@section('pagecontent')
<section class="container">
  <div class="page404Wrap">
    <img src="images/prox.png" alt="">
    <p>Esta página estará disponible próximamente</p>
    <a href="{{ url('/') }}" class="homePage">Home</a>
  </div>
</section>
@endsection
