 {!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group ">
                {!! Form::label('costo', 'Costo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('costo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('costo', '<p class="help-block">:message</p>') !!}
                </div>
                </div>


  
             <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('tipopersona', 'Tipo Persona: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select( null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tipopersona', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



      



 {!! Form::close() !!}


                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>