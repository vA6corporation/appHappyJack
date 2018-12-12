<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
  protected $fillable = [
      'name', 'game', 'denominate', 'maker', 'series', 'position', 'number', 'state',
      'observation', 'room_id', 'lastTurnover', 'lastTotalwin', 'hasBill', 'lastBill'
  ];

  public function count()
  {
    return $this->belongsTo('App\Count');
  }
}
