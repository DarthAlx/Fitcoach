<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Cart;
use Input;
use App\Direcciones;

class CartController extends Controller
{

    public function shoppingCart()
    {

      $items=Cart::content();
      return view('cart.index',['items'=>$items]);
    }
    public function addToCart()
    {
      if (Input::get('tipo')=="particular") {
        Cart::add(Input::get('id'),Input::get('name'),1,Input::get('price'), ['tipo'=>Input::get('tipo'),'fecha'=>Input::get('fecha'),'horario' => Input::get('horario'),'direccion'=>Input::get('direccion')]);
        dd("particular");
      }

      if (Input::get('tipo')=="fitcoach") {
        Cart::add(Input::get('id'),Input::get('name'),1,Input::get('price'), ['tipo'=>Input::get('tipo'),'fecha'=>Input::get('fecha'),'zona' => Input::get('zona')]);
        dd("fitcoach");
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
      $cliente = \Conekta\Customer::find($request->conektaid);

      if ($cliente->payment_sources->total>0) {

        foreach ($cliente->payment_sources as $tarjeta) {
          $tarjetas[]=$tarjeta;
        }

        $contador=0;
        foreach ($tarjetas as $tarjeta) {
          $cliente->payment_sources[$contador]->delete();
          $contador++;
        }
      }
      else {

          /*$cliente= \Conekta\Customer::create(
            array(
              "name" => $request->name,
              "email" => $request->email,
              "payment_sources" => array(
                array(
                    "type" => "card",
                    "token_id" => $request->tokencard
                )
              )//payment_sources
            )//customer
          );*/


      }

      try{
        $order=\Conekta\Order::create(array(
          'currency' => 'MXN',
          "customer_info" => array(
            "customer_id" => $request->conektaid
          ), //customer_info
          'line_items' => array(
            array(
              'name' => 'Yoga',
              'unit_price' => 50000,
              'quantity' => 1
            ),
            array(
              'name' => 'Spinning',
              'unit_price' => 60000,
              'quantity' => 1
            ),
            array(
              'name' => 'Cardio',
              'unit_price' => 80000,
              'quantity' => 1
            )
          ),
          "metadata" => array("reference" => "12987324097", "more_info" => "lalalalala"),
          'charges' => array(
            array(
              'payment_method' => array(
                'type' => 'card',
                "token_id" => $request->tokencard
              )
            )
          )
        ));
        dd($order);
        } catch (\Conekta\ProccessingError $error){
        echo $error->getMesage();
        } catch (\Conekta\ParameterValidationError $error){
        echo $error->getMessage();
        } catch (\Conekta\Handler $error){
        echo $error->getMessage();
        }



    }

}
