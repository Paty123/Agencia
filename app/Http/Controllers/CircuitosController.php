<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circuito as Circuito;
use App\Ciudad as Ciudad;



use input;

class CircuitosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $circuitos=Circuito::all();

        return view ("productscir.index",["circuitos"=>$circuitos]); 

        


       return view("productscir.circuito");
    }

  public function autocomplete(Request $request){

  $nameT=$request->nameT;
  $data=Circuito::where('nameT','LIKE','%'.$nameT.'%')->take(10)->get();
  $result=array();
  foreach ($data as $key => $v) {
    
  $result[]=['id'=>$v->id,'value'=>$v->nameT];

  }

  return response()->json($result);



  }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $circuito =new Circuito;
        $ciudades = Ciudad::all(['id', 'name']);
        $ciudades = Ciudad::pluck('name', 'id');



        return view('circuitos/create',['circuito'=>$circuito,'ciudades'=>$ciudades]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
      $circuito=new Circuito;

      $circuito->nombre=$request->nombre;
      $circuito->descripcion=$request->descripcion;
      $circuito->imagen=$request->imagen;
      $circuito->incluye=$request->incluye;
      $circuito->noincluye=$request->noincluye;
      $circuito->terycond=$request->terycond;
      $circuito->ciudadsal_id=$request->ciudadsal_id;
      $circuito->ciudadllega_id=$request->ciudadllega_id;


      if($circuito->save()){
        return redirect("admin/circuitos/create");
      }
      else{
        return view("admin/circuitos/create",["circuitos"=>$circuito]);
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

        $circuito= Circuito::find($id);
        return view('circuitos',['circuito'=>$circuito]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       

        $circuito = Circuito::find($id);
        return view('productscir/edit',['circuito'=>$circuito]);
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
        

    $circuito=Circuito::find($id);

      $circuito->nameT=$request->nameT;
      $circuito->price=$request->price;


      if($circuito->save()){
        return redirect("productscir");
      }
      else{
        return view("productscir/edit",["circuito"=>$circuito]);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Circuito::destroy($id);

       return redirect('/productscir');
    }
}
