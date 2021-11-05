@extends('layouts.app')

@section('content')
    @include('layouts.searchBar')
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('_partials.errors')
            <div class="card  mb-3">
                <div class="card-header">Edit recipe</div>
                <div class="card-body text-primary">
                    <form action="{{route('recipes.update', $recipe)}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="text-dark" for="category">Select Category</label>
                            <select class="form-control @error('category') is-invalid @enderror" id="category"
                                    name="category">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($recipe->category_id == $category->id)
                                    selected @endif>{{$category->name}}</option>
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
                                   value="{{$recipe->title}}"
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
                            >{{$recipe->procedure}}</textarea>

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
                            >{{$recipe->ingredients}}</textarea>

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
                                   value="{{$recipe->duration}}"
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
                            <a class="btn btn-outline-secondary" href="{{route('recipes.show', $recipe)}}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
