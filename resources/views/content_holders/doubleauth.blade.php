<?php
if (Auth::user()->role!=$role&&Auth::user()->role!=$role2){
  Session::flash('mensaje', 'No tienes permisos para ver esta página');
  Session::flash('class', 'warning');
  ?>
  <script type="text/javascript">
    window.location.href = "{{ url('/404') }}";
  </script>
  <?php
}
