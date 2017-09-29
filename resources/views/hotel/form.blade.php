
           {!! Form::open(['url' => $url, 'method' =>$method, 'novalidate', 'files'=>true]) !!}
                
                

                <div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}} ">
                {!! Form::label('nombre', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nombre',$hotel->nombre, '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}} ">
                {!! Form::label('direccion', 'Dirección: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('direccion', $hotel->direccion,'<p class="help-block">:message</p>') !!}
                </div>
                </div>


                 <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}} ">
                {!! Form::label('telefono', 'Telefono: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('telefono',$hotel->telefono,'<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group {{ $errors->has('correo') ? 'has-error' : ''}} ">
                {!! Form::label('correo', 'Correo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('correo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('correo', $hotel->correo,'<p class="help-block">:message</p>') !!}
                </div>
                </div>
               

               <div class="form-group {{ $errors->has('personacontacto') ? 'has-error' : ''}} ">
                {!! Form::label('personacontacto', 'Persona Contacto: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('personacontacto', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('personacontacto', $hotel->personacontacto,'<p class="help-block">:message</p>') !!}
                </div>
                </div>


                 <div class="form-group {{ $errors->has('imagen') ? 'has-error' : ''}}">
                {!! Form::label('imagen', 'Imagen: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('imagen') !!}
                    {!! $errors->first('imagen', '<p class="help-block">:message</p>') !!}
                </div>
              </div>

               
               <div class="form-group {{ $errors->has('estrellas') ? 'has-error' : ''}}">
                {!! Form::label('estrellas', 'Estrellas: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('estrellas', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('estrellas',$hotel->descripcion, '<p class="help-block">:message</p>') !!}
                </div>

              </div>

                <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : ''}}">
                {!! Form::label('descripcion', 'Descripcion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('descripcion', null, ['class'=>'wyseditor']) !!}
                    {!! $errors->first('descripcion', $hotel->descripcion,'<p class="help-block">:message</p>') !!}
                </div>
            </div>



          

              
        <div class="form-group {{ $errors->has('ciudad') ? 'has-error' : ''}}">
                {!! Form::label('ciudad_id', 'Ciudad de Salida: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('ciudad_id', $ciudades, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ciudad_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


             <div class="form-group {{ $errors->has('publicado') ? 'has-error' : ''}}">
                {!! Form::label('publicado', 'Publicado: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="radio">
                        <label>{!! Form::radio('publicado', '1', true) !!} Yes</label>
                    </div>
                    <div class="radio">
                        <label>{!! Form::radio('publicado', '0') !!} No</label>
                    </div>
                    {!! $errors->first('publicado', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


 


                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>









                {!! Form::close() !!}