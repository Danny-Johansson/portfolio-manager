@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('update') @lang($singular) @lang('image')
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.image.submit')}}" enctype="multipart/form-data">
        @include('partials.inputs.image')
        @include('partials.submit.edit_image')
    </form>
@endsection
