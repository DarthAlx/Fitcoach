@extends('plantilla')

@section('pagecontent')

  <section class="container-bootstrap">
    <div class="row">
      <div class="topclear">
        &nbsp;
      </div>
      <div class="checkoutPage clear">
        <div class="clear"></div>
        @include('content_holders.notificaciones')
        <div class="col-sm-6">
  				<h3>Recuperación de contraseña</h3>
          <form class="row" action="{{ url('/password/email ') }}" method="post">
            <p class="col-sm-6">
    					<label>Ingresa tu email</label><br>
    					<input class="form-control" type="email" value="{{ old('email') }}" placeholder="tu@email.com" name="email">
              {!! csrf_field() !!}
    				</p>
            <div class="col-sm-12">
              <input class="btn btn-primary" type="submit" value="Enviar">

            </div>


          </form>
  				<div class="clear"></div>
  			   </div>
          <div class="clear"></div>
		     </div>
       </div>
     </section>
        @endsection
