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
use App\Slide;
use Validator;

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


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    protected function validatorUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'confirmed|min:6'
        ]);
    }
    public function addUser(Request $request){


      $validator = $this->validator($request->all());

      if ($validator->fails()) {
          $this->throwValidationException(
              $request, $validator
          );
      }
      else {
        $guardar = new User($request->all());
        $guardar->save();
        Session::flash('mensaje', 'Usuario guardado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/usuarios'));
      }
    }
    public function updateUser(Request $request, $id)
    {
      $validator = $this->validatorUpdate($request->all());

      if ($validator->fails()) {
          $this->throwValidationException(
              $request, $validator
          );
      }
      else {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);

        $user->save();
        Session::flash('mensaje', 'Usuario actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/usuarios'));
      }

    }

    public function destroyUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('mensaje', 'Usuario eliminado correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/usuarios'));
    }

    public function buscar(Request $request){
      $usuarios = User::where('name', 'like', '%' . $request->buscar . '%')->orWhere('email', 'like', '%' . $request->buscar . '%')->orWhere('role', 'like', '%' . $request->buscar . '%')->paginate(10);
      return view('usuarios', ['usuarios'=>$usuarios]) ;
    }




    public function addSlide(Request $request){


      if ($request->hasFile('image')) {
        $file = $request->file('image');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {


          $name = "Slide" . $request->order . "." . $file->getClientOriginalExtension();
          $path = base_path('images/content/');

          $file-> move($path, $name);

          $guardar = new Slide($request->all());
          $guardar->image = $name;

          $guardar->save();
          Session::flash('mensaje', 'Slide guardado correctamente!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/slides'));
        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/slides'));
        }

      }
      else{
        Session::flash('mensaje', 'El archivo no es una imagen valida.');
        Session::flash('class', 'danger');
        return redirect()->intended(url('/slides'));
      }
    }
    public function updateSlide(Request $request, $id)
    {


      if ($request->hasFile('image')) {
        $file = $request->file('image');
        if ($file->getClientOriginalExtension()=="jpg" || $file->getClientOriginalExtension()=="png") {
          $name = "Slide" . $request->order . "." . $file->getClientOriginalExtension();
          $path = base_path('images/content/');
          $file-> move($path, $name);
          $slide = Slide::find($id);
          File::delete($path . $slide->image);
          $slide->image = $name;
          $slide->description = $request->description;
          $slide->order = $request->order;
          $slide->save();


          Session::flash('mensaje', 'Slide actualizado!');
          Session::flash('class', 'success');
          return redirect()->intended(url('/slides'));
        }
        else{
          Session::flash('mensaje', 'El archivo no es una imagen valida.');
          Session::flash('class', 'danger');
          return redirect()->intended(url('/slides'));
        }

      }
      else{
        $slide = Slide::find($id);
        $slide->description = $request->description;
        $slide->order = $request->order;
        $slide->save();
        Session::flash('mensaje', 'Slide actualizado!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/slides'));
      }








    }

    public function destroySlide(Request $request, $id)
    {
        $slide =Slide::find($id);
        $slide->delete();
        Session::flash('mensaje', 'Slide eliminado correctamente!');
        Session::flash('class', 'success');
        return redirect()->intended(url('/slides'));
    }
}
