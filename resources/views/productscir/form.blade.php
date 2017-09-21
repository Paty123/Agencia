



{!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                <div class="form-group">
                      {!! Form::label('full_nameT', 'Circuito') !!}
                      {!! Form::text('nameT', $circuito->nameT, ['class' => 'form-control' , 'required' => 'required']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::label('nameT', 'Precio') !!}
                      {!! Form::text('price',$circuito->price, ['class' => 'form-control' , 'required' => 'required']) !!}
                  </div>
                <div class="form-group">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
            {!! Form::close() !!}