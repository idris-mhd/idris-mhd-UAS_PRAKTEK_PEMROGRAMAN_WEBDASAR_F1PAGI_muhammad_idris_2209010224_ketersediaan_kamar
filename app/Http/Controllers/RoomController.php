<?php

// app/Http/Controllers/RoomController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class RoomController extends Controller
{
    public function index()
    {
        $availableRooms = Room::where('is_available', true)->get();
        $bookings = Booking::with('room')->get();

        return view('rooms.index', compact('availableRooms', 'bookings'));
    }

    public function storeCheckIn(Request $request)
    {
        $room = Room::where('room_number', $request->room_number)->first();
        if ($room && $room->is_available) {
            Booking::create([
                'room_id' => $room->id,
                'patient_name' => $request->name,
                'check_in_date' => $request->check_in_date,
            ]);
            $room->update(['is_available' => false]);

            return redirect()->back()->with('success', 'Check-in successful.');
        }

        return redirect()->back()->with('error', 'Room is not available.');
    }

    public function storeCheckOut(Request $request)
    {
        $booking = Booking::where('room_id', Room::where('room_number', $request->room_number)->first()->id)
                           ->whereNull('check_out_date')->first();
        if ($booking) {
            $booking->update(['check_out_date' => $request->check_out_date]);
            $booking->room->update(['is_available' => true]);

            return redirect()->back()->with('success', 'Check-out successful.');
        }

        return redirect()->back()->with('error', 'Booking not found.');
    }
}