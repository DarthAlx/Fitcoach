<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Detalles;
use App\Direcciones;
use App\Tarjetas;
use App\User;

class DetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        	if (Auth::guest()){
            return redirect()->intended(url('/entrar'));
          }
          else {
            $usuario = User::find(Auth::user()->id);
            if ($usuario->detalles) {
              if ($usuario->direcciones) {
                return view('detalles', ['tienedetalles'=>true,'tienedirecciones'=>true]);
              }
              else {
                return view('detalles', ['tienedetalles'=>true,'tienedirecciones'=>false]);
              }

            }
            else {
              return view('detalles', ['tienedetalles'=>false,'tienedirecciones'=>false]);
            }

          }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $bool=false;
      if ($request->dob) {
        $guardar = new Detalles($request->all());
        $guardar->save();
        return view('detalles', ['tienedetalles'=>true,'tienedirecciones'=>false]);
      }
      elseif ($request->calle) {
        $guardar = new Direcciones($request->all());
        $guardar->save();
        return view('detalles', ['tienedetalles'=>true,'tienedirecciones'=>true]);
      }
      elseif ($request->num) {
        $guardar = new Tarjetas($request->all());
        $guardar->save();
        return redirect()->intended(url('/perfil'));
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
