@extends('layouts.app')

@include(request()->segment(1).'.show_data')
