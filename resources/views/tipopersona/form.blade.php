 {!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group {{ $errors->has('tipo') ? 'has-error' : ''}}">
                {!! Form::label('tipo', 'Tipo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('tipo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tipo', $tipopersona->tipo,'<p class="help-block">:message</p>') !!}
                </div>
                </div>




                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>

                                

 {!! Form::close() !!}