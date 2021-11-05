@extends('layouts.app')

@section('content')
    @include('layouts.searchBar')
    @include('layouts.categories')
    @include('_partials.messages')

    @include('_partials.recipes')

@endsection
