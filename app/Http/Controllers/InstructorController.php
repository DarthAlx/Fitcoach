<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Detalles_instructor;
use App\Vehiculo;
use App\Tarjetas;
use App\User;
use App\Horarios;
class InstructorController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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






    public function addDetalles(Request $request)
    {
      $guardar = new Detalles_instructor($request->all());
      $guardar->photo = 'dummy.png';
      $guardar->save();
      Session::flash('mensaje', 'Perfil actualizado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    public function updateProfile(Request $request){
      $detalles = Detalles_instructor::find($request->detalles_id);
      $detalles->dob = $request->dob;
      $detalles->tel = $request->tel;
      $detalles->rfc = $request->rfc;
      $detalles->save();
      Session::flash('mensaje', 'Perfil actualizado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/perfil'));
    }

    public function updatePhoto(Request $request){
        if ($request->hasFile('photo')) {
          $file = $request->file('photo');
          if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
            $name = Auth::user()->id . "-". time()."." . $file->getClientOriginalExtension();
            $path = base_path('uploads/avatars/');
            $file-> move($path, $name);
            if ($request->user_id) {
              $detalles = new Detalles_instructor($request->all());
              $detalles->photo = $name;
              $detalles->save();
            }
            else {
              $detalles = Detalles_instructor::find($request->id);
              if ($detalles->photo !='dummy.png') {
                File::delete($path . $detalles->photo);
              }
              $detalles->photo = $name;
              $detalles->save();
            }

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

    public function addVehiculo(Request $request){
      $guardar = new Vehiculo($request->all());
      $guardar->save();
      Session::flash('mensaje', 'Vehiculo guardado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/vehiculos'));
    }
    public function updateVehiculo(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->identificador = $request->identificador;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->color = $request->color;
        $vehiculo->placa = $request->placa;
        $vehiculo->save();
        Session::flash('mensaje', 'Vehiculo actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/vehiculos'));
    }

    public function destroyVehiculo(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);
        $vehiculo->delete();
        Session::flash('mensaje', 'Vehiculo eliminado correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/vehiculos'));
    }


    public function addHorario(Request $request){
      $guardar = new Horarios($request->all());
      $guardar->save();
      Session::flash('mensaje', 'Horario guardado!');
      Session::flash('class', 'success');
      return redirect()->intended(url('/horarios'));
    }
    public function updateHorario(Request $request, $id)
    {
        $horario = Horarios::find($id);
        $horario->clases_id = $request->clases_id;
        $horario->fecha = $request->fecha;
        $horario->hora = $request->hora;
        $horario->save();
        Session::flash('mensaje', 'Horario actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/horarios'));
    }

    public function destroyHorario(Request $request, $id)
    {
        $horario = Horarios::find($id);
        $horario->delete();
        Session::flash('mensaje', 'Horario eliminado correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/horarios'));
    }
}
