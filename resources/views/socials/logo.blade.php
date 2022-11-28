@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('create') @lang($singular)
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.logo.submit',['social' => $data->id])}}" enctype="multipart/form-data">
        @include('partials.inputs.logo')
        @include('partials.submit.edit')
    </form>
@endsection
