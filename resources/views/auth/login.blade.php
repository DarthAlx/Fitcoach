@extends('plantilla')

@section('pagecontent')

  <section class="container">
    <div class="contentWrap">
      <div class="topclear">
        &nbsp;
      </div>
      <div class="checkoutPage clear">
        <div class="clear"></div>
        <div class="fcell">
  				<h3>Iniciar Sesión</h3>
          <form class="" action="{{ url('/entrar') }}" method="post">
            <p class="form-row form-row-first">
    					<label>Usuario</label>
    					<input class="input-text " type="text" value="{{ old('email') }}" placeholder="tu@email.com" name="email">
    				</p>
    				<p class="form-row form-row-last">
    					<label>Contraseña</label>
    					<input class="input-text " type="text" value="" placeholder="" name="password">
              {!! csrf_field() !!}
    				</p>

            <p class="form-row form-row-first">
    					<input class="input-text " type="checkbox" name="remember"> Recordarme
    				</p>
            <input type="submit" name="" value="Enviar">
          </form>
  				<div class="clear"></div>
  			   </div>
          <div class="clear"></div>
		     </div>
       </div>
     </section>
        @endsection
