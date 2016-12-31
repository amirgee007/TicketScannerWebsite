@extends('layouts.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @section('dashboard')
                        <div class="panel-heading">Dashboard - Home</div>

                        <a href="{{ action("AppController@eventAdd") }}" class="list-group-item">Add an event</a>
                        <a href="{{ action("AppController@eventEdit") }}" class="list-group-item">List events</a>
                    @show
                </div>
            </div>
        </div>
    </div>
@endsection
