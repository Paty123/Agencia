
{!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group ">
                {!! Form::label('nombre', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
                </div>
                </div>


                <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('descripcion', 'Descripcion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('descripcion', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                 

                 <div class="form-group {{ $errors->has('imagen') ? 'has-error' : ''}}">
                {!! Form::label('imagen', 'Imagen: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('imagen') !!}
                    {!! $errors->first('imagen', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

            


                <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('incluye', 'Incluye: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('incluye', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('incluye', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('noincluye', 'No incluye: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('noincluye', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('noincluye', '<p class="help-block">:message</p>') !!}
                </div>
            </div>




            

             <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('descripcion', 'Descripcion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select( null, ['class' => 'form-control']) !!}
                    {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('descripcion', 'Descripcion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select( null, ['class' => 'form-control']) !!}
                    {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


              <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('terycon', 'Terminos y condiciones: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('terycon', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('terycon', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            


          <!--      <div class="form-group">
                      {!! Form::label('full_nameT', 'Circuito') !!}
                      {!! Form::text('nameT', $circuito->nameT, ['class' => 'form-control' , 'required' => 'required']) !!}
                  </div>


                  <div class="form-group">
                      {!! Form::label('nameT', 'Precio') !!}
                      {!! Form::text('price',$circuito->price, ['class' => 'form-control' , 'required' => 'required']) !!}
                  </div>

-->

 {!! Form::close() !!}


                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>
           