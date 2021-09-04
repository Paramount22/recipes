@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('_partials.errors')
            <div class="card  mb-3">
                <div class="card-header">Create recipe</div>
                <div class="card-body text-primary">
                    <form action="{{route('recipes.store')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="text-dark" for="category">Select Category</label>
                            <select class="form-control @error('category') is-invalid @enderror" id="category"
                                    name="category">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-dark" for="title">Title</label>
                            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror"
                                   name="title"
                                   value="{{old('title')}}"
                                   placeholder="Title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="procedure">Procedure</label>

                            <textarea name="procedure" id="procedure" rows="15"
                                      class="form-control @error('procedure') is-invalid @enderror"
                                      placeholder="Procedure"
                            >{{old('procedure')}}</textarea>

                            @error('procedure')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="ingredients">Ingredients (coma - separator)</label>

                            <textarea name="ingredients" id="ingredients" rows="5"
                                      class="form-control @error('ingredients') is-invalid @enderror"
                                      placeholder="Ingredients"
                            >{{old('ingredients')}}</textarea>

                            @error('Ingredients')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="duration">Duration</label>
                            <input type="number" id="duration" class="form-control @error('duration') is-invalid @enderror"
                                   name="duration"
                                   value="{{old('duration')}}"
                                   placeholder="Duration">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="image">Picture (optional)</label>
                            <input type="file" id="image" class="form-control @error('image') is-invalid @enderror"
                                   name="image"
                            >

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
