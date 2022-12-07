@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('update') @lang(request()->segment(1).".".$singular)
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.logo.submit',[$singular => $data->id])}}" enctype="multipart/form-data">
        @include('partials.inputs.file',['name' => 'logo','required' => true,'accept' => 'image/*'])
        @include('partials.submit.edit')
    </form>
@endsection
