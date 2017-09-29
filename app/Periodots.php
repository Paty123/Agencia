<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodots extends Model
{
  

  protected $table = 'periodosts';
  protected $fillable = ['desde','hasta','opendate','minperson','tour_id'];
  protected $guarded = ['id'];
}
