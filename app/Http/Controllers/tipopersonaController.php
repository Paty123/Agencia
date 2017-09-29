<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipoper as Tipoper;


class tipopersonaController extends Controller
{


 public function index()
    {
        
    }


public function create()
    {
        $tipopersona =new Tipoper;
        


        return view('tipopersona/create',['tipopersona'=>$tipopersona]);
    }


public function store(Request $request)
    {
          $tipopersona=new Tipoper;


          $tipopersona->tipo=$request->tipo;
       



         if($tipopersona->save()){
        return redirect("admin/tipopersona/create");
      }
      else{
        return view("admin/tipopersona/create",["tipopersona"=>$tipopersona]);
      }

    }
















}
