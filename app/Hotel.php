<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Hotel extends Model
{
       
  protected $table = 'hotels';
  protected $fillable = ['nombre','direccion','telefono','correo','personacontacto','imagen','descripcion','publicado','estrellas','ciudad_id'];
  protected $guarded = ['id'];
 




 public function setImagenAttribute($imagen){
    

    if(!empty($imagen)){
    	
    $this->attributes['imagen']=Carbon::now()->second.$imagen->getClientOriginalName();
    $name=Carbon::now()->second.$imagen->getClientOriginalName();
    \Storage::disk('public')->put($name,\File::get($imagen));


}
    }
}
