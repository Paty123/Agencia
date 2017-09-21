
           {!! Form::open(['url' => $url, 'method' =>$method, 'novalidate']) !!}
                
                

                <div class="form-group ">
                {!! Form::label('nombre', 'Nombre: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group ">
                {!! Form::label('direccion', 'Dirección: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
                </div>
                </div>


                 <div class="form-group ">
                {!! Form::label('telefono', 'Telefono: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
                </div>
                </div>

                 <div class="form-group ">
                {!! Form::label('correo', 'Correo: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('correo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('correo', '<p class="help-block">:message</p>') !!}
                </div>
                </div>
               

               <div class="form-group ">
                {!! Form::label('personacontacto', 'Persona Contacto: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('personacontacto', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('personacontacto', '<p class="help-block">:message</p>') !!}
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
                {!! Form::label('descripcion', 'Descripcion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('descripcion', null, ['class'=>'wyseditor']) !!}
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
                {!! Form::label('descripcion', 'Descripcion: ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select( null, ['class' => 'form-control']) !!}
                    {!! $errors->first('descripcion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


              

 {!! Form::close() !!}


                <div class="form-group">
                  <div class="col-sm-6">
                      {!! Form::submit('Enviar', ['class' => 'btn btn-success ' ] ) !!}
                  </div>
                </div>