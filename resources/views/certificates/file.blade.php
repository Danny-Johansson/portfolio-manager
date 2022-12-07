@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang('system.update') @lang(request()->segment(1).".".$singular) @lang('inputs.file')
@endsection

@section('content')
    <h2 class="mb-4">
        @lang(request()->segment(1).".".$singular) : {{$data->name}}
    </h2>
    <form
        method="post"
          action="{{route(request()->segment(1).'.file.submit',[$singular => $data->id])}}"
          enctype="multipart/form-data"
    >
        @include('partials.inputs.file',['name' => 'file','required' => true,'accept' => '.pdf'])

        @include('partials.submit.edit')
    </form>
@endsection
