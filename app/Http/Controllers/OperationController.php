<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operation;

class OperationController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    //
  }

  public function byDateRange($sd, $ed, $room_id) {
    $operations = Operation::whereHas('machine', function($query) use ($room_id) {
      $query->where('room_id', $room_id);
    })->with('machine')->whereBetween('created_at', [$sd, $ed])->orderBy('created_at', 'desc')->get();
    return ['operations' => $operations];
  }

  public function byDateRangeAndPosition($sd, $ed, $position, $operation, $room_id) {
    $operations = Operation::whereHas('machine', function($query) use ($position, $room_id) {
      $query->where('position', $position)->where('room_id', $room_id);
    })->whereBetween('created_at', [$sd, $ed])->where('type', $operation)->with('machine')->orderBy('created_at', 'desc')->get();
    return ['operations' => $operations];
  }

  // $sales = Sale::whereHas('customer', function($query) use ($business_id) {
  //   $query->where('business_id', $business_id);
  // })->with('customer', 'customer.business', 'customer.office', 'customer.job')
  //   ->whereBetween('created_at', [date($startDate), date($endDate)])->get();

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // $operation =  new Operation($request->all());
    if ($request->relleno) {
      $operation =  new Operation([
        'cash' => $request->relleno,
        'type' => '0',
        'machine_id' => $request->machine,
        //'count_id' => $request->count_id
      ]);
      $operation->save();
    }
    if ($request->retiro) {
      $operation =  new Operation([
        'cash' => $request->retiro,
        'type' => '1',
        'machine_id' => $request->machine,
        //'count_id' => $request->count_id
      ]);
      $operation->save();
    }
    if ($request->pago) {
      $operation =  new Operation([
        'cash' => $request->pago,
        'type' => '2',
        'machine_id' => $request->machine,
        //'count_id' => $request->count_id
      ]);
      $operation->save();
    }
    return $request->all();
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
