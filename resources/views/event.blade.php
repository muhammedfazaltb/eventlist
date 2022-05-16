@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Event') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{route('user.eventpost')}}">
                        @csrf
                        <div class="row mb-3">
                            <label for="event_name" class="col-md-4 col-form-label text-md-end">{{ __('Event name ') }}</label>                            <div class="col-md-6">
                                <input id="event_name" type="text" class="form-control"  name="event_name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="start_date" class="col-md-4 col-form-label text-md-end">{{ __('Start date') }}</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control" name="start_date" required>
                            </div>
                        </div>
                       <div class="row mb-3">
                            <label for="end_date" class="col-md-4 col-form-label text-md-end">{{ __('End date') }}</label>
                        <div class="col-md-6">
                                <input id="end_date" type="date" class="form-control" name="end_date" required>
                        </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create event') }}
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
