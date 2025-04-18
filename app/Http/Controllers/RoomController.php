<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Display list of rooms
    public function index()
    {
        $rooms = Room::all(); // get all rooms from DB
        return view('rooms.index', compact('rooms'));
    }

    // Show form to create a room (admin)
    public function create()
    {
        return view('rooms.create');
    }

    // Save a new room to the database
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price_per_night' => 'required|numeric',
        'available_rooms' => 'required|integer',
    ]);

    //Room::create($request->all()); 
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price_per_night' => 'required|numeric',
        'available_rooms' => 'required|integer',
    ]);
    
    Room::create($validated);



    return redirect()->route('rooms.index')->with('success', 'Room added successfully!');
}

public function edit(Room $room)
{
    return view('rooms.edit', compact('room'));
}

public function update(Request $request, Room $room)
{
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'price_per_night' => 'required|numeric',
        'available_rooms' => 'required|integer',
    ]);

    $room->update($validated);
    return redirect()->route('rooms.index')->with('success', 'Chambre mise à jour');
}

public function destroy(Room $room)
{
    $room->delete();
    return redirect()->route('rooms.index')->with('success', 'Chambre supprimée');
}

}

