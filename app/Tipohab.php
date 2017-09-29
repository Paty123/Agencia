<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipohab extends Model
{
    

 protected $table = 'tipohabitaciones';
  protected $fillable = ['type', 'adultos','infantes'];
  protected $guarded = ['id'];
 


}
