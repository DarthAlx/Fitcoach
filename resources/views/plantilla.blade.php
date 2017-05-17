<!DOCTYPE html>
<html lang="es-mx">
	<head>
		<title>Fitcoach México | El club en tu casa</title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta name="description" content="Nuestro objetivo es activar las áreas comunes de los condominios dándoles una administración de club deportivo. Actividades deportivas, culturales y sociales en la comodidad de tu casa.">
        <meta name="keywords" content="clases,deportivas,culturales,sociales,curso,verano,carrera,fitcoach,domicilio,instructores,profesores,deportes,interlomas,santa fe,areas,comunes">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<!--[if lte IE 8]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!--[if lt IE 8]>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
		<![endif]-->
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="css/bxslider.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/selectric.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/adaptive.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">





		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/vendor/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.selectric.min.js"></script>
		<script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>





<script>


</script>

	</head>
<body class="home">

   <header id="header"><div class="headerWrap clear">
<a class="logo" id="logo" href="{{ url('/') }}">
        <img src="images/logo-black.png" alt="" width="161" height="46" class="logo-white">
        <img class="logo-black" src="images/logo-black.png" width="117" height="34" alt="">
</a>
			<nav class="mainMenu">
				<ul id="menu" class="clear">

					<li>
						<a href="{{ url('/proximamente') }}">activación</a>
				  </li>
                        <li>
						<a>Clases</a>
						<ul>
							<li><a href="{{ url('/clasesdeportivas') }}">Deportivas</a></li>
							<li><a href="{{ url('/proximamente') }}">Culturales</a></li>
                            <li><a href="{{ url('/proximamente') }}">Eventos</a></li>
						</ul>
					</li>
					<li>
						<a href="{{ url('/nosotros') }}">Nosotros</a>

					</li>
					<li><a>Tienda</a></li>
					<li>
						<a href="{{ url('/contacto') }}">Contacto</a>

					</li>
					@if (Auth::guest())
          	<li class="current-menu-item"><a href="{{ url('/entrar') }}">entrar</a></li>
					@else
						<li class="current-menu-item"><a href="{{ url('/perfil') }}">{{ Auth::user()->name }} {{ Auth::user()->remember }}</a>
							<ul>
								<li><a href="{{ url('/salir') }}">salir</a></li>
							</ul>
						</li>
					@endif
				</ul>
		  </nav>
			<span class="showMobileMenu">
				<span></span>
				<span></span>
				<span></span>
				<span></span>
			</span>
  </div></header>


  @yield('pagecontent')





  <footer id="footer" class="clear">

    <div class="footerSocial clear">
  			<a href="http://www.facebook.com/fitcoachmx"><i class="fa fa-facebook"></i></a>
  			<a href="http://www.twitter.com/fitcoachmx"><i class="fa fa-twitter"></i></a>
  			<a href="http://www.instagram.com/fitcoachmx"><i class="fa fa-instagram"></i></a>
  		</div>
  		<ul class="footerMenu clear">
  			<li><a href="{{ url('/aviso') }}">Aviso de Privacidad</a></li>
  			<li><a href="{{ url('/proximamente') }}">Términos y Condiciones</a></li>
  			<li><a href="{{ url('/proximamente') }}">Bolsa de Trabajo</a></li>

  		</ul>
  		<div class="footerSubscribe">
  			<form>
  				<input class="" type="text" name="" size="20" value="" placeholder="Email">
  				<input class="btnSubscribe" type="submit" value="Subscribirse">
  			</form>
  		</div>
  		<div class="copyright">
  			<p>Copyright &copy; 2015. FITCOACH México</p>
  		</div>

	</footer>
    <div class="mobileMenu" id="mobmenu">
      <ul>
      			<li class="current-menu-item"><a href="{{ url('/') }}">home</a></li>
      					<li>
      						<a href="{{ url('/proximamente') }}">activación</a>
      				  </li>
                              <li>
      						<a>Clases</a>
      						<ul>
      							<li><a href="{{ url('/clasesdeportivas') }}">Deportivas</a></li>
      							<li><a href="{{ url('/proximamente') }}">Culturales</a></li>
                                  <li><a href="{{ url('/proximamente') }}">Eventos</a></li>
      						</ul>
      					</li>
      					<li>
      						<a href="{{ url('/nosotros') }}">Nosotros</a>

      					</li>
      					<li><a>Tienda</a></li>
      					<li>
      						<a href="{{ url('/contacto') }}">Contacto</a>

      					</li>
      		</ul>
    </div>

    <script>
  (function (w,i,d,g,e,t,s) {w[d] = w[d]||[];t= i.createElement(g);
    t.async=1;t.src=e;s=i.getElementsByTagName(g)[0];s.parentNode.insertBefore(t, s);
  })(window, document, '_gscq','script','//widgets.getsitecontrol.com/12737/script.js');
</script>

</body>
</html>
