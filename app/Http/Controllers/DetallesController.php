<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Detalles;
use App\Direcciones;
use App\Tarjetas;
use App\User;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $file = $request->file('photo');
        if ($request->hasFile('photo')) {
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


            $name = Auth::user()->id . "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/avatars/');

            $file-> move($path, $name);

            $guardar = new Detalles($request->all());
            $guardar->photo = $name;

            $guardar->save();
            return view('detalles', ['tienedetalles'=>true,'tienedirecciones'=>false]);
          }
          else{
            return view('detalles', ['tienedetalles'=>false,'tienedirecciones'=>false]);
          }

        }
        else{
          return view('detalles', ['tienedetalles'=>false,'tienedirecciones'=>false]);
        }



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

    public function updatePhoto(Request $request){


        if ($request->hasFile('photo')) {
          $file = $request->file('photo');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


            $name = Auth::user()->id . "." . $file->getClientOriginalExtension();
            $path = base_path('uploads/avatars/');

            $file-> move($path, $name);
            $detalles = Detalles::find($request->id);
            $detalles->photo = $name;
            $detalles->save();
            return redirect()->intended(url('/perfil'));
          }
          else{
            return redirect()->intended(url('/perfil'))->with('errors', 'El archivo no es una imagen valida.');
          }

        }
        else{
          return redirect()->intended(url('/perfil'))->with('errors', 'El archivo no es una imagen valida.');
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

    public function updateAddress(Request $request, $id)
    {
        $direccion = Direcciones::find($id);
        $direccion->identificador = $request->identificador;
        $direccion->calle = $request->calle;
        $direccion->numero_ext = $request->numero_ext;
        $direccion->numero_int = $request->numero_int;
        $direccion->colonia = $request->colonia;
        $direccion->municipio_del = $request->municipio_del;
        $direccion->cp = $request->cp;
        $direccion->estado = $request->estado;
        $direccion->save();
        return redirect()->intended(url('/perfil'));
    }
    public function destroyAddress(Request $request, $id)
    {
        $direccion = Direcciones::find($id);
        $direccion->delete();
        return redirect()->intended(url('/perfil'))->with('mensaje', 'Dirección eliminada correctamente');
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
