@extends('layouts.app')

@section('content')
    @include('layouts.searchBar')
    <header class="d-flex justify-content-center mt-4 mb-4">
        <h2 class="text-dark">{{$category->name}} </h2>
    </header>

    @include('_partials.show_recipes')
    {{$recipes->links()}}


@endsection
