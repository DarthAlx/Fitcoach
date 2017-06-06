<?php
if (Auth::user()->role!=$role){
  Session::flash('mensaje', 'No tienes permisos para ver esta página');
  Session::flash('class', 'warning');
  ?>
  <script type="text/javascript">
    window.location.href = "{{ url('/404') }}";
  </script>
  <?php
}
