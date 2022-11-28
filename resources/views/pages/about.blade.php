@extends('layouts.app')

@section('heading')
    @lang('about') {{$owner->first_name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-auto">
            @if(isset($owner->image) AND !empty($owner->image))
                <img
                    src="{{$owner->image}}"
                    alt="{{$owner->first_name}} {{$owner->last_name}}"
                    class="float-start d-inline"
                    style="max-width:10em;"
                >
            @endif
        </div>
        <div class="col-auto">
            @lang('journeyman')
            <br><br>
            @lang('spare_time')
        </div>
    </div>
@endsection
