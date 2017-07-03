<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Cart;
use Input;
use App\Direcciones;
use App\Orden;
use App\User;
use App\Horarios;
use App\Zona;
use App\Clases;
use App\Tarjetas;


class CartController extends Controller
{
    public function product($id){
      date_default_timezone_set('America/Mexico_City');

      $clase=Clases::find($id);
      $user = User::find(Auth::user()->id);
      return view('cart.product',['clase'=>$clase,'user'=>$user]);
    }

    public function shoppingCart()
    {
      $user = User::find(Auth::user()->id);
      $items=Cart::content();
      return view('cart.index',['items'=>$items,'user'=>$user]);
    }
    public function addToCart(Request $request)
    {
      if ($request->tipo =="particular") {
        Cart::add($request->clase_id,$request->nombre,1,$request->precio, ['tipo'=>$request->tipo,'fecha' => $request->fecha,'horario' => $request->horario,'direccion'=>$request->direccion]);
      }
      if ($request->tipo=="fitcoach") {
        Cart::add($request->clase_id,$request->nombre,1,$request->precio, ['tipo'=>$request->tipo,'zona' => $request->zona]);
      }
      return redirect()->intended(url('/carrito'));
    }
    public function removeToCart($rowId)
    {
        Cart::remove($rowId);
        Session::flash('mensaje', 'La clase se eliminó del carrito.');
        Session::flash('class', 'success');
        return redirect()->intended(url('/carrito'));

    }
    public function updateCart($rowId,$qty)
    {
        Cart::update($rowId, $qty);

        return redirect()->intended(url('/carrito'));

    }

    public function cargo(Request $request)
    {
      \Conekta\Conekta::setApiKey("key_fr9YE9Y98jxYQ9NJrJTZXw");
      $items=Cart::content();

      foreach ($items as $product) {
        $precio = $product->price;
        $decimales   = '.';
        $pos = strpos($precio, $decimales);
        if ($pos === false) {
            $precio_completo=$precio.".00";
        }
        else {
          $precio_completo=$product->price;
        }
        if ($product->options->tipo=="particular"){
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => str_replace('.', '',$precio_completo),
            'quantity' => 1,
            'metadata' => array(
              'tipo' => $product->options->tipo,
              'fecha' => $product->options->fecha,
              'horario' => $product->options->horario,
              'direccion' => $product->options->direccion
            )
          );
        }
        if ($product->options->tipo=="fitcoach"){
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => str_replace('.', '',$precio_completo),
            'quantity' => 1,
            'metadata' => array(
              'tipo' => $product->options->tipo,
              'zona' => $product->options->zona
            )
          );
        }


      }


      try{
        $order=\Conekta\Order::create(array(
          'currency' => 'MXN',
          "customer_info" => array(
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone
          ), //customer_info
          'line_items' => $productos,
          'charges' => array(
            array(
              'payment_method' => array(
                'type' => 'card',
                "token_id" => $request->tokencard
              )
            )
          )
        ));
        if ($request->identificador) {
          $tarjeta = new Tarjetas();
          $tarjeta->identificador = $request->identificador;
          $tarjeta->num= $request->numero;
          $tarjeta->nombre = $request->nombre;
          $tarjeta->mes = $request->mes;
          $tarjeta->año = $request->año;
          $tarjeta->user_id = $request->user_id;
          $tarjeta->save();
        }

        foreach ($productos as $producto) {
          $guardar = new Orden();
          $guardar->order_id=$order->id;
          $guardar->user_id=$request->user_id;
          $guardar->name=$producto['name'];
          $guardar->unit_price=$producto['unit_price'];
          $guardar->metadata=implode(";", $producto['metadata']);
          $guardar->save();
        }
        Cart::destroy();

        Session::flash('mensaje', "Orden completada! revisa <a class='alert-link' href='".url('/mis-ordenes')."'>tus ordenes.</a>");
        Session::flash('class', 'success');
        return redirect()->intended(url('/carrito'));

        } catch (\Conekta\ProccessingError $error){
        echo $error->getMesage();
        } catch (\Conekta\ParameterValidationError $error){
        echo $error->getMessage();
        } catch (\Conekta\Handler $error){
        echo $error->getMessage();
        }



    }

    public function llenar_horarios(Request $request){
      ?>
      <option value="">Selecciona tu horario</option>
      <?php
        $options = "";
  			 $fecha = $request->fecha;
         list($dia, $mes, $año) = explode("-", $fecha);
         $datetime1 = date_create($año."-".$mes."-".$dia);
         $datetime2 =date_create(date("Y")."-".date("m")."-".date("d"));
         $interval = date_diff($datetime2, $datetime1);
         $dia_n=date("w", mktime(0, 0, 0, $mes, $dia, $año));
         $clase=Clases::find($request->clase);
  			 foreach($clase->horarios as $horario)
  			 {
           if (intval($interval->format('%R%a'))>=0) {
             if ($horario->fecha==$fecha||in_array($dia_n, explode(",",$horario->recurrencia))) {
               ?>
      				 <option value="<?=$horario->id ?>"><?=$horario->hora ?> | <?=$horario->user->name ?> | 4.6 ★</option>
      				 <?php
             }
           }



  			 }

    }
    public function llenar_horarios2(){
      ?>
      <option value="">Selecciona tu horario</option>
      <?php
         $options = "";
  			 $fecha = Input::get('fecha');
         list($dia, $mes, $año) = explode("-", $fecha);
         $datetime1 = date_create($año."-".$mes."-".$dia);
         $datetime2 =date_create(date("Y")."-".date("m")."-".date("d"));
         $interval = date_diff($datetime2, $datetime1);
         dd(intval($interval->format('%R%a')));

         $dia_n=date("w", mktime(0, 0, 0, $mes, $dia, $año));
         $clase=Clases::find(Input::get('clase'));
  			 foreach($clase->horarios as $horario)
  			 {
           if($horario->fecha!=""){
             list($dia_h, $mes_h, $año_h) = explode("-", $horario->fecha);
             $datetime2 = date_create($año_h."-".$mes_h."-".$dia_h);
             $interval = date_diff($datetime2, $datetime1);
           }



           if ($horario->fecha==$fecha||in_array($dia_n, explode(",",$horario->recurrencia))) {
             ?>
    				 <option value="<?=$horario->id ?>"><?=$horario->hora ?> | <?=$horario->user->name ?> | 4.6 ★</option>
    				 <?php
           }

  			 }

    }

}
