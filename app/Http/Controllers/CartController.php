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

class CartController extends Controller
{
    public function product($id){
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
    public function addToCart()
    {
      if (Input::get('tipo')=="particular") {
        Cart::add(Input::get('id'),Input::get('name'),1,Input::get('price'), ['tipo'=>Input::get('tipo'),'horario' => Input::get('horario'),'direccion'=>Input::get('direccion')]);
      }
      if (Input::get('tipo')=="fitcoach") {
        Cart::add(Input::get('id'),Input::get('name'),1,Input::get('price'), ['tipo'=>Input::get('tipo'),'fecha'=>Input::get('fecha'),'zona' => Input::get('zona')]);
      }
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
        if ($product->options->tipo=="particular"){
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => str_replace('.', '',$product->price),
            'quantity' => 1,
            'metadata' => array(
              'tipo' => $product->options->tipo,
              'horario' => $product->options->horario,
              'direccion' => $product->options->direccion
            )
          );
        }
        if ($product->options->tipo=="fitcoach"){
          $productos[]=array(
            'name' => $product->name,
            'unit_price' => str_replace('.', '',$product->price),
            'quantity' => 1,
            'metadata' => array(
              'tipo' => $product->options->tipo,
              'fecha' => $product->options->fecha,
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

        Session::flash('mensaje', 'Orden completada!');
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

}
