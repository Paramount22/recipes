@extends('layouts.app')

@section('content')
    <div class="search-value mb-3 text-center">
        <h3> You have searched for:  <strong class="text-info">"{{$query}}"</strong></h3>
    </div>
    @include('_partials.recipes')
@endsection
