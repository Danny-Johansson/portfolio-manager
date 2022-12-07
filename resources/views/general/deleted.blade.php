@extends('layouts.app')

@section('heading')
    @lang('system.deleted') @lang(request()->segment(1).".plural")
@endsection

@section('top')
    @include('partials.page_elements.index_top')
@endsection

@section('content')
    @if(count($data) >= 1)
        <table class="table table-striped table-hover table-bordered  border-4">
            <thead class="text-capitalize fw-bold">
                <tr>
                    @include(request()->segment(1)."labels")
                    <th>@lang("inputs.action")</th>
                </tr>
            </thead>
            <tbody class="text-capitalize">
                @foreach($data as $object)
                    <tr>
                        @include(request()->segment(1).".display_data")

                        @include('partials.page_elements.deleted_actions',['col' => '3'])
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('partials.page_elements.display_count')
    @else
        @include('partials.page_elements.no_deleted_results')
    @endif
@endsection
