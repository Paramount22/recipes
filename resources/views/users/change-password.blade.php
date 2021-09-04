@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('_partials.errors')
            @include('_partials.messages')
            <div class="card">

                <div class="card-header">{{ __('Change password') }}</div>

                <div class="card-body">

                    <div class="form-group">
                        <label>User name</label>
                        <input class="form-control" type="text" disabled value="{{$user->name}}">
                    </div>


                    <form action="{{route('update.password', $user->id)}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="old_password">Old password</label>
                            <input type="password" class="form-control @error('old_password') is-invalid
                                    @enderror" name="old_password"
                                   id="old_password">
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="new_password">New password</label>
                            <input type="password" class="form-control @error('old_password') is-invalid
                                    @enderror" name="new_password" id="new_password">

                            @error('new_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm_password">Confirm password</label>
                            <input type="password" class="form-control @error('confirm_password') is-invalid
                                    @enderror" name="confirm_password" id="confirm_password">

                            @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <button class="btn btn-info">Save</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
