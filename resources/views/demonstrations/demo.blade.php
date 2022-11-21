@extends('layouts.strict')

@section('content')
    @include('demonstrations.demos.'.request()->segment(2))
@endsection
