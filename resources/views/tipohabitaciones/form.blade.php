 {!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                {!! Form::label('type', 'Tipo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('type', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('type',$tipohab->type, '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group {{ $errors->has('adultos') ? 'has-error' : ''}} ">
                {!! Form::label('adultos', 'Adultos: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('adultos', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('adultos',$tipohab->adultos, '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group {{ $errors->has('infantes') ? 'has-error' : ''}} ">
                {!! Form::label('infantes', 'Infantes: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('infantes', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('infantes',$tipohab->infantes, '<p class="help-block">:message</p>') !!}
                </div>
                </div>





                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>



                 

 {!! Form::close() !!}