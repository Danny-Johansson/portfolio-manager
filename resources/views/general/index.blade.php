@extends('layouts.app')

@include(request()->segment(1).'.index_data')
