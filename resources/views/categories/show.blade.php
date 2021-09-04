@extends('layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h2>{{$category->name}} </h2>
    </header>

    @include('_partials.recipes')
    {{$recipes->links()}}


@endsection
