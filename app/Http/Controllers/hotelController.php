<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hotel as Hotel;
use App\Ciudad as Ciudad;

class hotelController extends Controller
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
        $hotel =new Hotel;
        $ciudades = Ciudad::all(['id', 'name']);
        $ciudades = Ciudad::pluck('name', 'id');



        return view('hotel/create',['hotel'=>$hotel,'ciudades'=>$ciudades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $hotel=new Hotel;

      $hotel->nombre=$request->nombre;
      $hotel->direccion=$request->direccion;
      $hotel->telefono=$request->telefono;
      $hotel->correo=$request->correo;
      $hotel->personacontacto=$request->personacontacto;
      $hotel->imagen=$request->imagen;
      $hotel->descripcion=$request->descripcion;
      $hotel->publicado=$request->publicado;
      $hotel->estrellas=$request->estrellas;
      $hotel->ciudad_id=$request->ciudad_id;
  


      
      if($hotel->save()){
        return redirect("admin/hotel/create");
      }
      else{
        return view("admin/hotel/create",["circuitos"=>$circuito]);
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
