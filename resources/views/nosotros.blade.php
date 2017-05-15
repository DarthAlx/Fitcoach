@extends('plantilla')

@section('pagecontent')
<section class="container">
  <div class="pageHeader" style="background-image: url(images/content/nosotros.jpg);">

  </div>
  <div class="ourStory">
    <div class="wrapper">
      <div class="storyItem clear">
        <div class="storyImg">
          <img src="images/content/story.jpg" alt="">
        </div>
        <div class="storyDesc">
          <h3>Nuestra Historia</h3>
          <p>FITCOACH México nace en el 2015 bajo la problemática del poco uso que tienen las áreas comunes de los edificios mas lujosos de México.  </p>
          <p>Gracias a nuestra experiencia en la administración de clubes deportivos, podemos convertir estas instalaciones en todo lo que tu familia necesita para tener un estilo de vida saludable y divertido. </p>
          <p>Damos el servicio de clases deportivas, culturales y sociales de manera directa al cliente o a traves de la administración de cada condominio.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="ourTeam">
    <div class="blockTitle">nuestros clientes</div>
    <div class="teamItemWrap clear">
      <div class="teamItem">
        <img src="images/content/nosotros/clientes/sayabesa.jpg" alt="">
        <div class="overlay">
          <div class="teamItemNameWrap">
            <h3>Residencial Sáyabes</h3>
          </div>
          <p>Bosque Real</p>
        </div>
      </div>

              <div class="teamItem">
        <img src="images/content/nosotros/clientes/toledo.jpg" alt="">
        <div class="overlay">
          <div class="teamItemNameWrap">
            <h3>Residencial Toledo</h3>
          </div>
          <p>Interlomas</p>
        </div>
      </div>

              <div class="teamItem">
        <img src="images/content/nosotros/clientes/isladeagua.jpg" alt="">
        <div class="overlay">
          <div class="teamItemNameWrap">
            <h3>Residencial Isla de Agua</h3>
          </div>
          <p>Interlomas</p>
        </div>
      </div>

              <div class="teamItem">
        <img src="images/content/nosotros/clientes/laenramada.jpg" alt="">
        <div class="overlay">
          <div class="teamItemNameWrap">
            <h3>La Enramada</h3>
          </div>
          <p>Lomas Country Club</p>
        </div>
      </div>

    </div>
  </div>
  <div class="ourValues">
    <div class="blockTitle">MISIÓN</div>
    <div class="parallaxBox" data-type="parallax" data-speed="10" style="background-image: url(images/content/ourValues1.jpg);">
      <h3 style="text-shadow:#000">Mejorar el bienestar de las personas a través del deporte, sin que tengan que salir de casa.</h3>
    </div>
    <div class="wrapper">
      <div class="blockTitle">VISIÓN</div>
    </div>
    <div class="parallaxBox" data-type="parallax" data-speed="10" style="background-image: url(images/content/ourValues2.jpg);">
      <h3>Ser el mejor proveedor de experiencias deportivas, sociales y culturales en México</h3>
    </div>
    <div class="wrapper">
      <div class="blockTitle">VALORES</div>
    </div>
    <div class="parallaxBox" data-type="parallax" data-speed="10" style="background-image: url(images/content/ourValues4.jpg);">
      <h3>Los valores que nos distinguen son: calidad, compromiso, honestidad, dedicación, respeto, confianza, puntualidad y excelencia.</h3>
    </div>
  </div>
  <div class="ourInstagram">
    <div id="sb_instagram">
      <div class="sb_instagram_header">
        <a href="#" class="sbi_header_link">FITCOACHMX</a>
      </div>
      <div id="instafeed">




      </div>
    </div>
  </div>
</section>
@endsection
