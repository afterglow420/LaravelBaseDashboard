<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BookingModel;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // public function index(Request $request) 
    // {
    //     if($request->ajax()) {
       
    //         $data = BookingModel::whereDate('booking_start', '>=', $request->booking_start)
    //                    ->whereDate('booking_end',   '<=', $request->booking_end)
    //                    ->get(['id_booking', 'booking_title', 'booking_start', 'booking_end']);
  
    //         return response()->json($data);
    //     }
  
    //     return view('Dashboard.calendar');
    // }

    // public function ajax(Request $request)
    // {
    //     switch ($request->type) {
    //        case 'add':
    //             $event = BookingModel::create([
    //                 'title' => $request->booking_title,
    //                 'start' => $request->booking_start,
    //                 'end' => $request->booking_end,
    //             ]);
 
    //             return response()->json($event);
    //         break;
  
    //         case 'update':
    //             $event = BookingModel::find($request->id_booking)->update([
    //                 'title' => $request->booking_title,
    //                 'start' => $request->booking_start,
    //                 'end' => $request->booking_end,
    //             ]);
 
    //             return response()->json($event);
    //         break;
  
    //         case 'delete':
    //             $event = BookingModel::find($request->id_booking)->delete();
                
    //             return response()->json($event);
    //         break;
             
    //         default:
    //         # code...
    //         break;
    //     }
    // }

    public function index()
    {
        $events = [];
 
        $bookings = BookingModel::all();
 
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => $booking->booking_name,
                'start' => $booking->booking_start,
                'end' => $booking->booking_end,
            ];
        }
        // $collection = new Collection($events);
        // $json = $collection->toJson(JSON_PRETTY_PRINT);
        
        // dd($events);
        
        return view('Dashboard.calendar', compact('events'));
    }
}
