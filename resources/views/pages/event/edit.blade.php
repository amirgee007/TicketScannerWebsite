@extends('pages.app')

@section('dashboard')

    <div class="panel-heading">Event List</div>

    <div class="panel-body">
        @if  (! empty($data))

            <ul>
                @foreach ($data as $item)
                <li><a href="/event/list/{{ $item->id }}">{{ $item->name }}</a></li>
                @endforeach
            </ul>
        @else
            No events added, add one.
        @endif

    </div>

@endsection
