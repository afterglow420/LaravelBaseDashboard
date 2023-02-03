<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingModel;
use App\Http\Requests\Booking\StoreBookingModelRequest;
use App\Http\Requests\Booking\UpdateBookingModelRequest;

class BookingController extends Controller

{
    public function index()
    {
        return view('Admin.Bookings.BookingsIndex_View', ['bookings' => BookingModel::all()]);
    }

    public function store(StoreBookingModelRequest $request)
    {
        BookingModel::create($request->validated());

        return redirect()->route('bookings.index')->with('message', 'Booking added successfully!');
    }

    public function show(BookingModel $booking)
    {
        $booking = BookingModel::where('id_booking', $booking->id_booking)->first();

        return view('Admin.Bookings.BookingsEdit_View', ['booking' => $booking]);
    }

    public function update(UpdateBookingModelRequest $request, BookingModel $booking)
    {
        $booking->fill($request->validated())->save();

        return redirect()->back()->with('message', 'Booking edited successfully!');
    }

    public function destroy(BookingModel $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('message', 'Booking successfully deleted');
    }
}
