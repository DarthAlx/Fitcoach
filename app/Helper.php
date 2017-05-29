<?php
use Illuminate\Support\Facades\Auth;




    function validarsesion(){
      if (Auth::guest()){
        
        return redirect(url('/entrar'));
      }
    }
