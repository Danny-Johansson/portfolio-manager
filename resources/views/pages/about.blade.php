@extends('layouts.app')

@section('heading')
    @lang('navigation.about') {{$owner->first_name}}
@endsection

@section('content')
    <div class="row">
        <div class="col-2" id="about_image">
            @if(isset($owner->image) AND !empty($owner->image))
                <img
                    src="{{$owner->image}}"
                    alt="{{$owner->first_name}} {{$owner->last_name}}"
                    class="float-start d-inline"
                    style="max-width:10em;"
                >
            @endif
        </div>
        <div class="col-10" id="about_text">
            @lang('about.journeyman')
            <br><br>
            @lang('about.spare_time')
            @lang('about.gaming')
            <br><br>
            @lang('about.fantasy')
            @lang('about.book')
            <br><br>
            @lang('about.programming')
        </div>
    </div>
@endsection
