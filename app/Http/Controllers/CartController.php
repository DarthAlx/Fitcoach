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
}
