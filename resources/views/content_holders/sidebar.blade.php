<div class="profile-sidebar">
  <!-- SIDEBAR USERPIC -->
  <div class="profile-userpic">
    <img src="{{ url('uploads/avatars') }}/{{ $user->detalles->photo }}" class="img-responsive" alt="">
  </div>
  <!-- END SIDEBAR USERPIC -->
  <!-- SIDEBAR USER TITLE -->
  <div class="profile-usertitle">
    <div class="profile-usertitle-name">
      {{ Auth::user()->name }}
    </div>
    <div class="profile-usertitle-job">
      {{ ucfirst(Auth::user()->role) }}
    </div>
  </div>
  <!-- END SIDEBAR USER TITLE -->
  <!-- SIDEBAR BUTTONS -->
  <div class="profile-userbuttons">

    <form style="display:none;" action="{{ url('/cambiar-foto') }}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="{{ $user->detalles->id }}">
      <input type="file" name="photo" id="cambiarfoto" onchange="javascript: document.getElementById('botoncambiarfoto').click();" required>
      {!! csrf_field() !!}
      <input type="submit" id="botoncambiarfoto">
    </form>
    <button type="button" onclick="javascript: document.getElementById('cambiarfoto').click();" class="btn btn-warning btn-sm" id="botoncambiar">Cambiar foto</button>
  </div>
  <!-- END SIDEBAR BUTTONS -->
  <!-- SIDEBAR MENU -->
  @if (Auth::user()->role=="cliente")
    <div class="profile-usermenu">
      <ul class="nav">
        <li>
          <a href="{{ url('/perfil') }}">
          <i class="fa fa-id-card-o" aria-hidden="true"></i></i>
          Detalles </a>
        </li>
        <li>
          <a href="#">
          <i class="fa fa-calendar" aria-hidden="true"></i></i>
          Clases </a>
        </li>
        <li class="active">
          <a href="{{ url('/direcciones') }}">
          <i class="fa fa-address-book" aria-hidden="true"></i>
          Direcciones </a>
        </li>
        <li>
          <a href="{{ url('/tarjetas') }}">
          <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
          Tarjetas </a>
        </li>

      </ul>
    </div>
  @endif
  @if (Auth::user()->role=="instructor")
    <div class="profile-usermenu">
      <ul class="nav">
        <li>
          <a href="{{ url('/perfilinstructor') }}">
          <i class="fa fa-id-card-o" aria-hidden="true"></i></i>
          Detalles </a>
        </li>
        <li>
          <a href="{{ url('/tarjetas') }}">
          <i class="fa fa-clock-o" aria-hidden="true"></i>
          Horarios </a>
        </li>
        <li>
          <a href="#">
          <i class="fa fa-calendar" aria-hidden="true"></i></i>
          Clases </a>
        </li>
        <li class="active">
          <a href="{{ url('/vehiculos') }}">
          <i class="fa fa-car" aria-hidden="true"></i>
          Vehiculos </a>
        </li>


      </ul>
    </div>
  @endif

  <!-- END MENU -->
</div>
