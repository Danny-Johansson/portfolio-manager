@extends('layouts.app')

@include(request()->segment(1).'.deleted_data')
