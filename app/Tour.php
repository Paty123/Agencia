<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tour extends Model
{
    protected $table = 'tours';
  protected $fillable = ['descripcion', 'nombre','imagen','incluye','noincluye','terycond','ciudadsal_id','ciudadllega_id'];
  protected $guarded = ['id'];
 




 public function setImagenAttribute($imagen){
    

    if(!empty($imagen)){
    	
    $this->attributes['imagen']=Carbon::now()->second.$imagen->getClientOriginalName();
    $name=Carbon::now()->second.$imagen->getClientOriginalName();
    \Storage::disk('public')->put($name,\File::get($imagen));


}
    }
}
