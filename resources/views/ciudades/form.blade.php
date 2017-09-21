




{!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group ">
                {!! Form::label('name', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name',$ciudades->name, '<p class="help-block">:message</p>') !!}
                </div>
                </div>

     <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>
              



 {!! Form::close() !!}


           