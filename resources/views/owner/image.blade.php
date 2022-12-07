@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('update') @lang(request()->segment(1).".".$singular) @lang('image')
@endsection

@section('content')
    <form method="post" action="{{route(request()->segment(1).'.image.submit')}}" enctype="multipart/form-data">
        @include('partials.inputs.file',['name' => 'image','required' => true,'accept' => 'image/*'])
        @include('partials.submit.edit_image')
    </form>
@endsection
