<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create()
    {
        $rooms = Room::all();
        return view('reservations.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
        ]);

        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully!');
    }
    public function index()
    {
        $user = Auth::user();
    
        if ($user->is_admin) {
            // Admin: fetch all reservations
            $reservations = Reservation::with(['user', 'room'])->get();
        } else {
            // Regular user: fetch only their reservations
            $reservations = Reservation::with('room')
                ->where('user_id', $user->id)
                ->get();
        }
    
        return view('dashboard', compact('reservations'));
    }
   
    

    public function userDashboard()
    {
        $reservations = Reservation::with('room')
            ->where('user_id', auth()->id())
            ->get();
    
        return view('user.dashboard', compact('reservations'));
    }
    


    public function destroy(Reservation $reservation)
{
    //only the owner can delete their reservation
    if ($reservation->user_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }

    $reservation->delete();

    return redirect()->route('reservations.index')->with('success', 'Reservation cancelled successfully.');
}
}
