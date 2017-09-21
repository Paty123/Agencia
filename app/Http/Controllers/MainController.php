<?php

namespace App\Http\Controllers;
use App\Http\Request;



class MainController extends Controller{

public function login(){
	
	return view('auth.login',[]);
}
}





