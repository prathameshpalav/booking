@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Book My Show</b>

                    <span id="availanle-tickets">Available Tickets : <label>{{$available_tickets}}</label></span>
                </div>

                <div class="card-body">
                    @include('alerts')

                    <form method="POST" action="{{ route('bookings.book-a-show', $show->id) }}">
                        @csrf
                        <input type="hidden" name="show_id" value="{{$show->id}}">

                        <div class="form-group row">
                            <label for="movie" class="col-md-4 col-form-label text-md-right">Movie</label>

                            <div class="col-md-6">
                                <input id="movie" type="text" class="form-control @error('movie') is-invalid @enderror" name="movie" value="{{ $show->movie->name }}" placeholder="Movie" required readonly>

                                @error('movie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="theater" class="col-md-4 col-form-label text-md-right">Theater</label>

                            <div class="col-md-6">
                                <input id="theater" type="text" class="form-control @error('theater') is-invalid @enderror" name="theater" value="{{ $show->theater->name }}" placeholder="Theater" required readonly>

                                @error('theater')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">Amount per Person (Rs.)</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $show->amount_per_person }}" placeholder="amount" required readonly>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="show-date" class="col-md-4 col-form-label text-md-right">Show Date</label>

                            <div class="col-md-6">
                                <input id="show-date" type="text" class="form-control @error('show_date') is-invalid @enderror" name="show_date" value="{{ $show->date }}" placeholder="Show Date" required readonly>

                                @error('show_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="show-time" class="col-md-4 col-form-label text-md-right">Show Time</label>

                            <div class="col-md-6">                                
                                <select name="show_time" id="show-time" class="form-control @error('show_time') is-invalid @enderror">
                                    <option value="">Show Time</option>
                                    @foreach($shows as $same_date_show)
                                        <option value="{{$show->id}}" @if($show->start_time == $same_date_show->start_time) selected @endif>{{$show->start_time}}</option>
                                    @endforeach
                                </select>

                                @error('show_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no-of-tickets" class="col-md-4 col-form-label text-md-right">No of Tickets</label>

                            <div class="col-md-6">
                                @php $no_of_tickets = empty(old('no_of_tickets')) ? 1 : old('no_of_tickets'); @endphp
                                <input id="no-of-tickets" type="number" class="form-control @error('no_of_tickets') is-invalid @enderror" name="no_of_tickets" value="{{$no_of_tickets}}" placeholder="No of Tickets" required autofocus>

                                @error('no_of_tickets')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-md-12 text-center">                                
                                Amount to be Paid : <b>Rs. <span id="total-amount"></span></b>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Book My Show
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')    
    <script>
        $(function() {
            $('#show-time').select2();

            calculateTotalAmount();
            $('#no-of-tickets').on('change', function() {
                if($(this).val() < 0) {
                    $(this).val(1);
                }   

                calculateTotalAmount();
            });

            function calculateTotalAmount() {
                var tickets = parseInt($('#no-of-tickets').val());
                var amount = parseFloat($('#amount').val());

                tickets = isNaN(tickets) ? 0 : tickets;
                $('#total-amount').text(tickets * amount);
            }
        });
    </script>
@endsection