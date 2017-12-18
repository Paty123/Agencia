

@extends('layouts.admin')


<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS 


        <link href="{{ asset('http://fonts.googleapis.com/css?family=PT+Sans:400,700') }}" rel="stylesheet">
        <link href="{{ asset('css/supersized.css"') }}" rel="stylesheet">
        <link href="{{ asset('css/stilel.css"') }}" rel="stylesheet">-->


             <link rel="stylesheet" href="<?php echo URL::asset('css/supersized.css')?>">
             <link rel="stylesheet" href="<?php echo URL::asset('css/stilel.css')?>">
             <link rel="stylesheet" href="<?php echo URL::asset('http://fonts.googleapis.com/css?family=PT+Sans:400,700')?>">
       


    </head>


<body>


  @section('content') 
  
<div class="container">
<div class="row">

        <div class="col-md-8 col-md-offset-2">
                     <div class="fondo">    
                
                <div class="panel-heading"></div>

                <div class="panel-body">
  
      
                          
<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" >
                                    Iniciar Sesión
                                </button>




                                <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                    Olvidaste Tu Contraseña?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
 

</div>
</div>
</div>



@endsection
 <!-- Javascript -->}

    
 <script src="{{ asset('js/jquery-1.8.2.min.js')}}"></script>
 <script src="{{ asset('js/supersized.3.2.7.min.js')}}"></script>
 <script src="{{ asset('js/supersized-init.js')}}"></script>
 <script src="{{ asset('js/scripts.js')}}"></script>


 
     
  
</body>

</html>