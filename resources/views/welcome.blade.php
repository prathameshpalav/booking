@extends('layouts.app')

@section('content')
    <div class="container">

    @foreach($movies as $movie)
        <div class="movie-card">
            <div class="movie-header poster" style="background:url({{$movie->image_url}})">
                <div class="header-icon-container">
                    <a href="{{route('movies.show', $movie->slug)}}">                            
                    </a>
                </div>
            </div><!--movie-header-->
            <div class="movie-content">
                <div class="movie-content-header">
                    <a href="{{route('movies.show', $movie->slug)}}">
                        <h3 class="movie-title">{{$movie->name}}</h3>
                    </a>
                </div>
                <div class="movie-info">
                    <div class="info-section">
                        <label>Release Date</label>
                        <span>{{$movie->release_date}}</span>
                    </div><!--date,time-->
                    <div class="info-section">
                        <label>Rating</label>
                        <span>{{$movie->ratings}}</span>
                    </div><!--row-->
                    <div class="info-section">
                        <label>Run Time</label>
                        <span>{{$movie->running_time_in_minutes}} min</span>
                    </div><!--screen-->                                                        
                </div>
            </div><!--movie-content-->
        </div><!--movie-card-->    
    @endforeach

    </div><!--container-->
@endsection