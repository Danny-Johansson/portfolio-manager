@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('edit') @lang($singular) @if(!empty($data->name)) :  {{$data->name}}@else @lang('with') ID : {{$data->id}}@endif
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.update',[$singular => $data->id])}}">
        @include(request()->segment(1).'.edit_data')
        @include('partials.submit.edit')
    </form>
@endsection
