@extends('layouts.app')

@section('content')
<header class="d-flex justify-content-between align-items-center">
    <h2>{{$user->name}} </h2>
    <p> {{ Str::plural( 'Recipe', $count) }}: {{$count}} </p>
</header>


 @include('_partials.recipes')
 {{ $recipes->links() }}


@endsection
