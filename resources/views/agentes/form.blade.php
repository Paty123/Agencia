 {!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group ">
                {!! Form::label('nombre', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group ">
                {!! Form::label('direccion', 'Correo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group ">
                {!! Form::label('direccion', 'Telefono: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
                </div>
                </div>


                 <div class="form-group ">
                {!! Form::label('telefono', 'Agencia: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
                </div>
                </div>
  


                 

 {!! Form::close() !!}


                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>