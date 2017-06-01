<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

    public function updateProfile(Request $request){
      $detalles = Detalles::find($request->detalles_id);
      $detalles->dob = $request->dob;
      $detalles->tel = $request->tel;
      $detalles->intereses = $request->intereses;
      $detalles->save();
      Session::flash('mensaje', 'Perfil actualizado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    public function updatePassword(Request $request){
      if ($request->password==$request->password_confirmation && Auth::user()->id == $request->user_id) {
        $user = User::find($request->user_id);
        $user->password=bcrypt($request->password);
        $user->save();
        Session::flash('mensaje', 'Contraseña actualizada!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/perfil'));
      }
      else {
        Session::flash('mensaje', 'Las contraseñas deben coincidir!');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/perfil'));
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

        if ($request->hasFile('photo')) {
          $file = $request->file('photo');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


            $name = Auth::user()->id ."-". time(). "." . $file->getClientOriginalExtension();
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
          $guardar = new Detalles($request->all());
          $guardar->photo = 'dummy.png';

          $guardar->save();
          return view('detalles', ['tienedetalles'=>true,'tienedirecciones'=>false]);
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

    public function addAddress(Request $request){
      $guardar = new Direcciones($request->all());
      $guardar->save();
      Session::flash('mensaje', 'Dirección guardada!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/direcciones'));
    }

    public function updatePhoto(Request $request){


        if ($request->hasFile('photo')) {
          $file = $request->file('photo');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


            $name = Auth::user()->id . "-". time()."." . $file->getClientOriginalExtension();
            $path = base_path('uploads/avatars/');

            $file-> move($path, $name);
            $detalles = Detalles::find($request->id);
            if ($detalles->photo !='dummy.png') {
              File::delete($path . $detalles->photo);
            }
            $detalles->photo = $name;
            $detalles->save();
            Session::flash('mensaje', 'Foto de perfil actualizada!');
            Session::flash('class', 'success');
            return redirect()->intended(url('/perfil'));
          }
          else{
            Session::flash('mensaje', 'El archivo no es una imagen valida.');
            Session::flash('class', 'danger');
            return redirect()->intended(url('/perfil'))->with('errors', 'El archivo no es una imagen valida.');
          }

        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
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
        Session::flash('mensaje', 'Dirección actualizada!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/direcciones'));
    }
    public function destroyAddress(Request $request, $id)
    {
        $direccion = Direcciones::find($id);
        $direccion->delete();
        Session::flash('mensaje', 'Dirección eliminada correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/direcciones'))->with('mensaje', 'Dirección eliminada correctamente');
    }


    public function addCard(Request $request){
      $guardar = new Tarjetas($request->all());
      $guardar->save();
      Session::flash('mensaje', 'Tarjeta guardada!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/tarjetas'));
    }
    public function updateCard(Request $request, $id)
    {
        $tarjeta = Tarjetas::find($id);
        $tarjeta->identificador = $request->identificador;
        $tarjeta->num = $request->num;
        $tarjeta->mes = $request->mes;
        $tarjeta->año = $request->año;
        $tarjeta->nombre = $request->nombre;
        $tarjeta->save();
        Session::flash('mensaje', 'Tarjeta actualizada!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/tarjetas'));
    }
    public function destroyCard(Request $request, $id)
    {
        $tarjeta = Tarjetas::find($id);
        $tarjeta->delete();
        Session::flash('mensaje', 'Tarjeta eliminada correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/tarjetas'));
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
