<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bottle extends Model
{
  protected $fillable = ['message', 'nickname', 'lat', 'lng', 'public'];
}
