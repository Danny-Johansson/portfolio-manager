@extends('layouts.app')

@section('top')
    @include('partials.page_elements.index_top')
@endsection

@section('content')
    @include(request()->segment(1).'.index_data')
@endsection

