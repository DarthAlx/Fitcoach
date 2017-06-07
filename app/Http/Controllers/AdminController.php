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
use App\Clases;

class AdminController extends Controller
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



    public function addClase(Request $request){

      if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


          $name = $request->nombre ."-". time(). "." . $file->getClientOriginalExtension();
          $path = base_path('uploads/clases/');

          $file-> move($path, $name);

          $guardar = new Clases($request->all());
          $guardar->imagen = $name;

          $guardar->save();
          Session::flash('mensaje', 'Clase guardada correctamente!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/clases'));
        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/clases'));
        }

      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/clases'));
      }
    }
    public function updateClase(Request $request, $id)
    {


      if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
          $name = $request->nombre . "-". time()."." . $file->getClientOriginalExtension();
          $path = base_path('uploads/clases/');
          $file-> move($path, $name);
          $clase = Clases::find($id);
          File::delete($path . $clase->imagen);
          $clase->imagen = $name;
          $clase->nombre = $request->nombre;
          $clase->tipo = $request->tipo;
          $clase->descripcion = $request->descripcion;

          $clase->precio = $request->precio;
          $clase->precio_especial = $request->precio_especial;
          $clase->save();


          Session::flash('mensaje', 'Clase actualizada!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/clases'));
        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/clases'));
        }

      }
      else{
        $clase = Clases::find($id);
        $clase->nombre = $request->nombre;
        $clase->tipo = $request->tipo;
        $clase->descripcion = $request->descripcion;
        $clase->precio = $request->precio;
        $clase->precio_especial = $request->precio_especial;
        $clase->save();


        Session::flash('mensaje', 'Clase actualizada!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/clases'));
      }






    }

    public function destroyClase(Request $request, $id)
    {
        $clase = Clases::find($id);
        $clase->delete();
        Session::flash('mensaje', 'Clase eliminada correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/clases'));
    }
}
