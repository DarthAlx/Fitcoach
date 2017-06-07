<div class="profile-sidebar">
  <!-- SIDEBAR USERPIC -->
  <div class="profile-userpic">
    @if ($user->detalles_instructor)
      <img src="{{ url('uploads/avatars') }}/{{ $user->detalles_instructor->photo }}" class="img-responsive" alt="">
    @else
      <img src="{{ url('uploads/avatars') }}/dummy.png" class="img-responsive" alt="">
    @endif

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

    <form style="display:none;" action="{{ url('/cambiar-foto-instructor') }}" method="post" enctype="multipart/form-data">
      @if ($user->detalles_instructor)
        <input type="hidden" name="id" value="{{ $user->detalles_instructor->id }}">
      @else
        <input type="hidden" name="user_id" value="{{ $user->id }}">
      @endif
      <input type="file" name="photo" id="cambiarfoto" onchange="javascript: document.getElementById('botoncambiarfoto').click();" required>
      {!! csrf_field() !!}
      <input type="submit" id="botoncambiarfoto">
    </form>
    <button type="button" onclick="javascript: document.getElementById('cambiarfoto').click();" class="btn btn-warning btn-sm" id="botoncambiar">Cambiar foto</button>
  </div>
  <!-- END SIDEBAR BUTTONS -->
  <!-- SIDEBAR MENU -->
    <div class="profile-usermenu">
      <ul class="nav">
        <li id="detallesmenu">
          <a href="{{ url('/perfilinstructor') }}">
          <i class="fa fa-id-card-o" aria-hidden="true"></i></i>
          Detalles </a>
        </li>
        <li id="horariosmenu">
          <a href="{{ url('/horarios') }}">
          <i class="fa fa-clock-o" aria-hidden="true"></i>
          Horarios </a>
        </li>
        <li id="clasesmenu">
          <a href="#">
          <i class="fa fa-calendar" aria-hidden="true"></i></i>
          Clases </a>
        </li>
        <li id="vehiculosmenu">
          <a href="{{ url('/vehiculos') }}">
          <i class="fa fa-car" aria-hidden="true"></i>
          Vehiculos </a>
        </li>


      </ul>
    </div>

  <!-- END MENU -->
</div>
<script type="text/javascript">
  $('#{{ $menu }}').addClass("active");
</script>
