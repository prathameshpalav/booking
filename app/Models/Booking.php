<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    /**
     * Available booking status constants
     */
    const PENDING = 'pending', CONFIRMED = 'confirmed', CANCELLED = 'cancelled';

    /**
     * Guard columns from mass assignment
     *
     */
    protected $guarded = ['id'];

    /**
     * This is scope query for confirmed bookings
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeConfirmed($query)
    {
        return $query->where('booking_status', self::CONFIRMED);
    }

    /**
     * Relationship: Booking belongs to many shows
     *
     */
    public function show()
    {
        return $this->belongsTo(Show::class);
    }

    /**
     * Mutator: Booking date
     *
     */
    public function getBookingDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }

    /**
     * Mutator: Booking status
     *
     */
    public function getDisplayBookingStatusAttribute()
    {
        $booking_array = [
            'pending'   => 'badge-warning',
            'confirmed' => 'badge-success',
            'cancelled' => 'badge-danger',
        ];

        return array_key_exists($this->booking_status, $booking_array) ? "<span class='badge {$booking_array[$this->booking_status]}'>{$this->booking_status}</span>" : $this->booking_status;
    }

    /**
     * Check if cancel booking allowed
     *
     */
    public function isCancelAllowed()
    {
        return (strtotime('now') <= strtotime('-1 hour '.$this->show->show_time) && $this->booking_status != self::CANCELLED);
    }

    /**
     * Fetch logged in user bookings from DB
     *
     * @static
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getMyBookings()
    {
        return self::with('show.movie','show.theater')->where('user_id', loggedInUserId())->paginate(10);
    }

    /**
     * Fetch no of booked/confirmed tickets by show from DB
     *
     * @static
     * @param \App\Models\Show $show
     * @return integer total no_of_tickets confirmed
     */
    public static function bookedTicketsByShow($show)
    {
        return self::where('show_id', $show->id)
                        ->confirmed()
                        ->sum('no_of_tickets');
    }

    /**
     * Cancel booking and update status in DB
     *
     * @static
     * @param string $booking_id
     * @return boolean
     */
    public static function cancelBooking($booking_id)
    {
        $booking = self::where('booking_id', $booking_id)->first();

        if($booking->isCancelAllowed()) {
            $booking->booking_status = self::CANCELLED;
            $booking->cancelled_at = Carbon::now();
            $booking->save();
            return true;
        }

        return false;
    }

    /**
     * Create booking in DB
     *
     * @static
     * @param \App\Models\Show $show
     * @param \App\Http\Requests\Bookings\BookingRequest $request
     * @return \App\Models\Booking
     */
    public static function bookShow($show, $request)
    {
        $booking = self::create([
            'user_id'           => loggedInUserId(),
            'booking_id'        => generateBookingId(),
            'show_id'           => $show->id,
            'no_of_tickets'     => $request->no_of_tickets,
            'total_amount'      => $request->no_of_tickets * $show->amount_per_person,
            'booking_status'    => self::CONFIRMED
        ]);

        if (is_null($booking)) {
            throw new \Exception('Booking failed.');
        }
    }
}
