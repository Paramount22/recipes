@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('_partials.errors')
            @include('_partials.messages')
            <div class="card">

                <div class="card-header">{{ __('Edit category') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid
                                    @enderror" name="name" value="{{$category->name}}" autocomplete="name"
                                   >

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info">
                                {{ __('Update') }}
                            </button>

                            <a class="btn btn-outline-secondary" href="{{route('categories.index')}}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
