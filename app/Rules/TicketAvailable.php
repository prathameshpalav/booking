<?php

namespace App\Rules;

use App\Models\Booking;
use App\Models\Show;
use Illuminate\Contracts\Validation\Rule;

class TicketAvailable implements Rule
{
    private $show_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($show_id)
    {
        $this->show_id = $show_id;
    }

    /**
     * Determine if tickets available or not.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $show = Show::with('theater')->find($this->show_id);

        $tickets = Booking::bookedTicketsByShow($show);
        
        $tickets = $tickets + $value;// confirmed tickets + requested tickets

        if( $tickets <= $show->theater->seats ) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tickets not available.';
    }
}
