<div class="profile-sidebar">
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

  <!-- SIDEBAR MENU -->
    <div class="profile-usermenu">
      <ul class="nav">
        <li id="clasesmenu">
          <a href="{{ url('/clases') }}">
          <i class="fa fa-calendar" aria-hidden="true"></i></i>
          Clases </a>
        </li>
        <li id="usuariosmenu">
          <a href="{{ url('/usuarios') }}">
          <i class="fa fa-users" aria-hidden="true"></i>
          Usuarios </a>
        </li>
      </ul>
    </div>

  <!-- END MENU -->
</div>
<script type="text/javascript">
  $('#{{ $menu }}').addClass("active");
</script>
