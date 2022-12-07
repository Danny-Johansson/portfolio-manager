@extends('layouts.app')

@section('top')
    @can('owner_update')
        @include('partials.page_elements.update_owner')
        @include('partials.page_elements.update_image')
    @endcan
@endsection

@section('heading')
    @lang('owner.owner')
@endsection

@section('content')
    @include(request()->segment(1).'.index_data')
@endsection
