<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodohot extends Model
{
    


  protected $table = 'periodosho';
  protected $fillable = ['desde','hasta','costosupmenor','hotel_id'];
  protected $guarded = ['id'];
