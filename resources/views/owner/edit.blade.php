@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('edit') @lang(request()->segment(1).".".$singular)
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.update',[$singular => $data->id])}}">
        @include(request()->segment(1).'.edit_data')
        @include('partials.submit.edit')
    </form>
@endsection

