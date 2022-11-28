@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('create') @lang($singular)
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.file.submit',['certificate' => $data->id])}}" enctype="multipart/form-data">
        @include('partials.inputs.file')
        @include('partials.submit.edit')
    </form>
@endsection
