<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
      'name', 'address'
    ];

    public function machines()
    {
      //return $this->belongsTo('App\Machine');
      return $this->hasMany('App\Machine');
    }
}
