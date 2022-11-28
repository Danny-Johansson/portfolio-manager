@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('create') @lang($singular)
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.store')}}" enctype="multipart/form-data">
        @include(request()->segment(1).".create_data")
        @include('partials.submit.create')
    </form>
@endsection
