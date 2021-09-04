@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('_partials.errors')
            @include('_partials.messages')
            <div class="card">
                <div class="card-header">{{ __('Edit profile') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img width="70" src="{{asset('images/avatars')}}/{{$user->avatar}}" alt="">
                        </div>

                        <div class="col-md-10">
                            <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')


                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid
                                    @enderror" name="name" value="{{ $user->name }}" autocomplete="name"
                                               autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-8">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ $user->email  }}" autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="avatar"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Avatar (optional)') }}</label>

                                    <div class="col-md-8">
                                        <input id="avatar" type="file"
                                               class="form-control" name="avatar"
                                        >
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-info">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection



