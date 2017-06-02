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
use App\Direcciones;
use App\Tarjetas;
use App\User;

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
}
