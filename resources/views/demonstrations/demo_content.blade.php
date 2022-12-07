@extends('layouts.app')

@section('top')
@endsection

@section('heading')
    @lang($data->name)
@endsection

@section('content')
    @php
        include($data->file);
    @endphp
@endsection
