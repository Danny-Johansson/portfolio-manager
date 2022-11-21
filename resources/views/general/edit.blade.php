@extends('layouts.app')

@include(request()->segment(1).'.form_data')
