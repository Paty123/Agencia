<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodocir extends Model
{
    

  protected $table = 'periodoscir';
  protected $fillable = ['desde','hasta','opendate','minperson','circuito_id'];
  protected $guarded = ['id'];


  



}
