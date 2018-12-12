<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
  protected $fillable = [
      'machine_id', 'count_id', 'initialTO', 'initialTW', 'finalTO',
      'finalTW', 'initialBill', 'finalBill', 'created_at'
  ];

  public function machine()
  {
    return $this->belongsTo('App\Machine');
  }

  public function bill()
  {
    // return $this->belongsTo('App\Bill');
    return $this->hasOne('App\Bill');
  }

  public function operations()
  {
    return $this->hasMany('App\Operation');
  }
}
