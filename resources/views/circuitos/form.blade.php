
{!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group ">
                {!! Form::label('nombre', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nombre',$circuito->nombre, '<p class="help-block">:message</p>') !!}
                </div>
                </div>


                <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('descripcion', 'Descripcion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('descripcion', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('descripcion',$circuito->descripcion, '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                 

                 <div class="form-group {{ $errors->has('imagen') ? 'has-error' : ''}}">
                {!! Form::label('imagen', 'Imagen: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('imagen') !!}
                    {!! $errors->first('imagen',$circuito->imagen,'<p class="help-block">:message</p>') !!}
                </div>
              </div>

            


                <div class="form-group {{ $errors->has('incluye') ? 'has-error' : ''}}">
                {!! Form::label('incluye', 'Incluye: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('incluye', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('incluye',$circuito->incluye, '<p class="help-block">:message</p>') !!}
                </div>
            </div>


                <div class="form-group {{ $errors->has('noincluye') ? 'has-error' : ''}}">
                {!! Form::label('noincluye', 'No incluye: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('noincluye', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('noincluye',$circuito->noincluye, '<p class="help-block">:message</p>') !!}
                </div>
            </div>




            

           <div class="form-group {{ $errors->has('ciudad') ? 'has-error' : ''}}">
                {!! Form::label('ciudadsal_id', 'Ciudad de Salida: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('ciudadsal_id', $ciudades, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ciudadsal_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


           <div class="form-group {{ $errors->has('ciudad') ? 'has-error' : ''}}">
                {!! Form::label('ciudadllega_id', 'Ciudad Destino: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('ciudadllega_id', $ciudades, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ciudadllega_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

             <div class="form-group {{ $errors->has('terycond') ? 'has-error' : ''}}">
                {!! Form::label('terycond', 'Terminos y Condiciones: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('terycod', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('terycond',$circuito->terycond, '<p class="help-block">:message</p>') !!}
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

  <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>

 {!! Form::close() !!}


               
          

          