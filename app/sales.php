<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
  

  protected $table = 'circuitos';
  protected $fillable = ['nameT', 'id'];
  protected $guarded = ['id'];
}
