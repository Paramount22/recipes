@extends('layouts.app')

@section('content')
    @include('layouts.searchBar')
    <div class="search-value mt-3 text-center">
        <h3> You have searched for:  <strong class="text-info">"{{$query}}"</strong></h3>
    </div>
    @include('_partials.show_recipes')
    {{ $recipes->links() }}
@endsection
