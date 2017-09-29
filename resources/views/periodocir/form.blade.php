
           {!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group {{ $errors->has('desde') ? 'has-error' : ''}} ">
                {!! Form::label('desde', 'Desde: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('desde', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nombre',$periodocir->desde, '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group {{ $errors->has('hasta') ? 'has-error' : ''}}">
                {!! Form::label('hasta', 'Hasta: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('hasta', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('hasta', $periodocir->hasta,'<p class="help-block">:message</p>') !!}
                </div>
                </div>


                 <div class="form-group {{ $errors->has('minperson') ? 'has-error' : ''}} ">
                {!! Form::label('minperson', 'Minimo de Personas: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('minperson', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('minperson',$periodocir->minperson, '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group {{ $errors->has('opendate') ? 'has-error' : ''}}">
                {!! Form::label('opendate', 'Habilitar reservaciones en cualquier fecha: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="radio">
                        <label>{!! Form::radio('opendate', '1', true) !!}Si</label>
                    </div>
                    <div class="radio">
                        <label>{!! Form::radio('opendate', '0') !!} No</label>
                    </div>
                    {!! $errors->first('opendate', $periodocir->minperson,'<p class="help-block">:message</p>') !!}
                </div>
            </div>






                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                      {!! Form::hidden('circuito_id', $circuito->id) !!}
                  </div>
                </div>

                 {!! Form::close() !!}