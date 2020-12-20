<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookings\BookingRequest;
use App\Http\Requests\Bookings\CancelBookingRequest;
use App\Models\Booking;
use App\Models\Show;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Show all bookings of logged in user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getMyBookings()
    {
        $bookings = Booking::getMyBookings();

        return view('bookings.my-bookings', compact('bookings'));
    }

    /**
     * Cancel a specific booking og logged inn user
     *
     * @param \App\Http\Requests\Bookings\CancelBookingRequest $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cancelMyBookings(CancelBookingRequest $request)
    {
        try{

            $booking = Booking::cancelBooking($request->booking_id);

            if($booking) {
                session()->flash('success', 'Your booking has been cancelled.');
            } else {
                session()->flash('success', 'Booking could not be cancelled.');
            }

        } catch(\Exception $e) {

            session()->flash('error', 'Something went wrong. Please try again.');
        }

        return redirect()->route('bookings.my-bookings');
    }

    /**
     * Show booking form
     *
     * @param \App\Models\Show $show
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showBookingForm(Show $show)
    {
        $shows = Show::showsOnSameDate($show);

        $booked_tickets     = Booking::bookedTicketsByShow($show);
        $total_tickets      = $show->theater->seats;
        $available_tickets  = $total_tickets - $booked_tickets;

        return view('bookings.booking-form', compact('show', 'shows', 'available_tickets'));
    }

    /**
     * Book a specific show
     *
     * @param \App\Models\Show $show
     * @param \App\Http\Requests\Bookings\BookingRequest $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bookShow(Show $show, BookingRequest $request)
    {
        try{

            Booking::bookShow($show, $request);

            session()->flash('success', 'Thank You! Your booking has been successfull.');            

        } catch(\Exception $e) {

            session()->flash('error', 'Something went wrong. Please try again.');
        }

        return redirect()->route('bookings.my-bookings');
    }
}
