@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>My Bookings</b></div>

                <div class="card-body">
                    @include('alerts')

                    <div class="table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Booking Id</th>
                                    <th>Movie</th>
                                    <th>Theater</th>
                                    <th>Show Date/Time</th>                                    
                                    <th>Tickets</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Booking Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($bookings->isEmpty())
                                    <tr class="text-center">
                                        <td colspan="9">You don't have any bookings yet.</td>
                                    </tr>
                                @else
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{$booking->booking_id}}</td>
                                            <td>{{$booking->show->movie->name}}</td>
                                            <td>{{$booking->show->theater->name}}</td> 
                                            <td>{{$booking->show->date}} {{$booking->show->start_time}}</td>                                            
                                            <td>{{$booking->no_of_tickets}}</td>
                                            <td>Rs.{{$booking->total_amount}}</td>
                                            <td>{!!$booking->display_booking_status!!}</td>
                                            <td>{{$booking->booking_date}}</td>
                                            <td>
                                                @if($booking->isCancelAllowed())
                                                <a class="btn btn-danger cancel-booking" data-bookingid="{{$booking->booking_id}}">Cancel</a>

                                                <form id="logout-form-{{$booking->booking_id}}" action="{{ route('bookings.cancel') }}" method="POST" class="d-none">
                                                    @csrf
                                                    <input type="hidden" name="booking_id" value="{{$booking->booking_id}}">
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right">
                        {!! $bookings->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script>
        $(function() {
            $('.cancel-booking').on('click', function() {
                cancelBooking($(this).data('bookingid'));
            });
            function cancelBooking(bookingid) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to cancel booking?',
                    icon: 'warning',                
                    confirmButtonText: 'Yes',
                    showCancelButton: true,
                    showCloseButton: true,
                    preConfirm: () => {                        
                        $('#logout-form-'+bookingid).submit();
                    }
                })
            }            
        });
    </script>
@endsection