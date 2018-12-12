<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Count;
use App\Machine;
use App\Bill;
use App\Operation;

class CountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['ok' => true];
    }

    public function byDateRange($sd, $ed, $room_id) {
      // Sale::whereHas('customer', function($query) use ($business_id) {
      //   $query->where('business_id', $business_id);
      // })
      $counts = Count::whereHas('machine', function($query) use ($room_id) {
        $query->where('room_id', $room_id);
      })->with('machine')->whereBetween('created_at', [$sd, $ed])->get();
      return ['counts' => $counts];
      // return [$sd, $ed];
    }

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
      $count = new Count($request->count);
      $count->save();
      $machine = Machine::find($request->count['machine_id']);
      $machine->count_id = $count->id;
      $machine->lastTotalwin = $count->finalTW;
      $machine->lastTurnover = $count->finalTO;
      $machine->lastBill =  $count->finalBill;
      $machine->lastReg = Carbon::now();
      $machine->save();
      Operation::where('machine_id', $machine->id)
          ->where('count_id', NULL)
          ->update(['count_id' => $count->id]);
      return ['count' => $count];
    }

    public function close(Request $request)
    {
      $count = Count::find($request->count['id']);
      $count->fill($request->count);
      $count->save();
      $bill = new Bill($request->bill);
      $bill->count_id = $count->id;
      $bill->save();
      $machine = Machine::find($request->count['machine_id']);
      $machine->count_id = NULL;
      $machine->save();
      return ['count' => $count];
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
