<?php

namespace App\Http\Requests\Bookings;

use App\Rules\TicketAvailable;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'show_id'       => 'required|integer',
            'show_time'     => 'required',
            'no_of_tickets' => ['required', 'integer', 'min:1', new TicketAvailable(request('show_id'))],
        ];
    }
}
