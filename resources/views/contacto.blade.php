@extends('plantilla')

@section('pagecontent')
<section class="container">
  <div class="pageHeader" style="background-image: url(images/content/bg-parallax2.jpg);">
    <h1></h1>
  </div>
  <div class="ourContact">
    <div class="wrapper clear">
      <div class="contactGallery">
        <ul>
          <li><img src="images/content/gallery.jpg" alt=""></li>
          <li><img src="images/content/story.jpg" alt=""></li>
        </ul>

      </div>
      <div class="contactInfo">
        <h3>Contacto</h3>
        <p><i class="contactPhone"></i> 044 55 2882 0141</p>
        <p><i class="contactEmail"></i> info@fitcoach.mx</p>
        <p><i class="contactLocation"></i>Oficinas Próximamente</p>
      </div>
    </div>
  </div>
</section>
@endsection
