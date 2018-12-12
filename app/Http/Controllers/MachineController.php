<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Machine;
use Carbon\Carbon;

class MachineController extends Controller
{

  public function changeState($id, $state)
  {
    $machine =  Machine::with('count')->find($id);
    if ($state ==  "true") {
      error_log('entramos al 0');
      $machine->state =  1;
    } else {
      $machine->state =  0;
      error_log('entramos al 1');
    }
    $machine->save();
    return ['machine' => $machine];
  }

  public function updateReg(Request $request)
  {
    $machine =  Machine::find($request->machine['id']);
    $machine->fill($request->machine);
    $machine->lastReg = Carbon::now();
    $machine->save();
    return ['machine' => $machine];
  }

  public function withoutRoom()
  {
    $machines = Machine::where('room_id', NULL)->get();
    return ['machines' => $machines];
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    // $machines = Machine::orderBy('position', 'asc')->get();
    $machines = Machine::with('count')->orderBy('position', 'asc')->get();
    //$machines = Machine::all();
    return ['machines' => $machines];
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
    $machine = new Machine($request->machine);
    $machine->save();
    return ['ok' => true];
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $machine = Machine::find($id);
    return ['machine' => $machine];
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
    $machine = Machine::find($id);
    $machine->fill($request->machine);
    $machine->save();
    return ['ok' => true];
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    Machine::destroy($id);
    return ['ok' => true];
  }
}
