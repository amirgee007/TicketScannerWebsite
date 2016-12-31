@extends('pages.app')



@section('dashboard')
    <div class="panel-heading">Event info</div>

    <div class="panel-body">
        <p>Below are the entered values.</p>
        <div class="row">
            <div class="col-sm-4">
                Event Title:
            </div>
            <div class="col-sm-8">
                <pre>{{ $data->name }}</pre>
            </div>
            <div class="col-sm-4">
                Code Values:
            </div>
            <div class="col-sm-8">

                @foreach ($codes as $code)
                    {{$code->code}} => {{$code->state}}
                    @if ($code->state === 'false')
                        => {{$code->updated_at}}
                    @endif
                    <br/>
                @endforeach

            </div>
        </div>
    </div>

@endsection
