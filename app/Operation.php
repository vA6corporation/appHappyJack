<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
  protected $fillable = [
      'cash', 'type', 'machine_id', 'count_id',
  ];

  public function machine()
  {
    return $this->belongsTo('App\Machine');
  }
}
