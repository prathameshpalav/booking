@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 text-center">
            <img class="movie-poster" src="{{$movie->image_url}}">
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2>{{$movie->name}}</h2>
                    <p>{{$movie->description}}</p>
                    <p>Ratings: 
                        @for($i=1; $i<=5; $i++) 
                            @if($i <= $movie->ratings) 
                                <i class="fa fa-heart fa-red"></i> 
                            @else
                                <i class="fa fa-heart-o"></i>
                            @endif
                        @endfor {{$movie->ratings}}
                    </p>
                    <p>Running Time: {{$movie->running_time_in_minutes}} minutes</p>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill movie-date-bar">
                        @for($i=0; $i<=5; $i++)
                            @php $unixdate = strtotime("+$i days"); @endphp
                            <li class="nav-item">
                                <a class="nav-link @if(isBookingDateActive($unixdate)) active @endif" href="{{route('movies.show', ['movie' => $movie->slug, 'date'=> date('Ymd', $unixdate)])}}">{{date('d M', $unixdate)}}</a>
                            </li>
                        @endfor
                    </ul>

                    @if($theaters->isEmpty())
                        <h5 class="text-center">Shows not available</h5>
                    @else
                        @foreach($theaters as $theater)
                            @if(!$theater->shows->isEmpty())
                                <div class="row m-2 pb-2 pt-2 @if(!$loop->last) border-bottom @endif">
                                    <div class="col-md-5">
                                        <h4>{{$theater->name}}</h4>                                
                                    </div>
                                    <div class="col-md-7">                                    
                                        @foreach($theater->shows as $show)
                                            <a href="{{route('bookings.booking-form', $show->id)}}" class="btn btn-outline-primary btn-sm">{{$show->start_time}}</a>
                                        @endforeach                                                            
                                    </div>
                                </div>                                                          
                            @endif
                        @endforeach                 
                    @endif
                </div>            
            </div>        
        </div>
    </div>
</div>
@endsection
