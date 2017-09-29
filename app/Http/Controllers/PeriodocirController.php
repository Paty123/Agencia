<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodocir as Periodocir;
use App\Circuito as Circuito;



class PeriodocirController extends Controller
{
    


     public function index()
    {
        
    }


     public function create(){
    
   
    $periodocir =new Periodocir;
        
    

    return view('periodocir/create',compact('circuito'),['periodocir'=>$periodocir]);


    }

    public function store(Request $request)
    {
     
      $periodocir=new Periodocir;

      $periodocir->desde=$request->desde;
      $periodocir->hasta=$request->hasta;
      $periodocir->opendate=$request->opendate;
      $periodocir->minperson=$request->minperson;
      $periodocir->circuito_id=$request->circuito_id;

     


      if($periodocir->save()){
        return redirect("admin/periodocir/create");
      }
      else{
        return view("admin/periodocir/create",["periodocir"=>$periodocir]);
      }


    }



}
