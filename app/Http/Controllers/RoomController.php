<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return ['rooms' => $rooms];
    }

    public function withMachines($room_id) {
      $room = Room::with(['machines' => function($query) {
        $query->orderBy('position');
      }])->where('id', $room_id)->first();
      return ['room' => $room];
    }

    public function allWithMachines() {
      $rooms = Room::with(['machines' => function($query) {
        $query->orderBy('position');
      }])->get();
      return ['rooms' => $rooms];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $room = new Room($request->room);
      $room->save();
      return ['room' => $room];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        return ['room' => $room];
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
        $room = Room::find($id);
        $room->fill($request->room);
        $room->save();
        return ['room' => $room];
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
