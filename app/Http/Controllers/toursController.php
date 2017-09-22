<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tour as Tour;
use App\Ciudad as Ciudad;

class toursController extends Controller
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
        
        $tour =new Tour;
        $ciudades = Ciudad::all(['id', 'name']);
        $ciudades = Ciudad::pluck('name', 'id');



        return view('tours/create',['tour'=>$tour,'ciudades'=>$ciudades]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tour=new Tour;

      $tour->nombre=$request->nombre;
      $tour->descripcion=$request->descripcion;
      $tour->imagen=$request->imagen;
      $tour->incluye=$request->incluye;
      $tour->noincluye=$request->noincluye;
      $tour->terycond=$request->terycond;
      $tour->ciudadsal_id=$request->ciudadsal_id;
      $tour->ciudadllega_id=$request->ciudadllega_id;


      if($tour->save()){
        return redirect("admin/tours/create");
      }
      else{
        return view("admin/tours/create",["tours"=>$tour]);
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
