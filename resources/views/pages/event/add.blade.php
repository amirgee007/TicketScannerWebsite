@extends('pages.app')

@section('dashboard')
    @if  (! empty($data))

        <div class="panel-heading">Event Added!</div>

        <div class="panel-body">
            <p>Your event has been added, view in in your <a href="{{ action("AppController@eventEdit") }}">event list page</a>.</p>
            <p>Below are the entered values.</p>
            <div class="row">
                <div class="col-sm-4">
                    Event Title:
                </div>
                <div class="col-sm-8">
                    <pre>{{ $data->eventName }}</pre>
                </div>
                <div class="col-sm-4">
                    Code Values:
                </div>
                <div class="col-sm-8">
                    <pre>{{ $data->eventCodes }}</pre>
                </div>
            </div>
        </div>
    @else

    <div class="panel-heading">Event add</div>

    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/event/add') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('eventName') ? ' has-error' : '' }}">
                <label for="eventName" class="col-md-4 control-label">Event Name</label>

                <div class="col-md-6">
                    <input id="eventName" type="text" class="form-control" name="eventName" value="{{ old('eventName') }}"
                           required autofocus>

                    @if ($errors->has('eventName'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('eventName') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('eventCodes') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Ticket codes</label>

                <div class="col-md-6">
                    <textarea rows="10" id="eventCodes" type="password" class="form-control" name="eventCodes"
                              required>{{ old('eventCodes') }}</textarea>
                    One entry per line please.

                    @if ($errors->has('eventCodes'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('eventCodes') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Add Event
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endif

@endsection
