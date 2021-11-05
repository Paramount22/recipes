@extends('layouts.app')

@section('content')
<header class="d-flex justify-content-between">
    <h2 class="text-dark">{{$user->name}} </h2>
    <p> {{ Str::plural( 'Recipe', $count) }}: {{$count}} </p>
</header>


 @include('_partials.show_recipes')
 {{ $recipes->links() }}


@endsection
