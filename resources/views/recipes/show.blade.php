@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
          {{-- @include('_partials.messages') --}}

            <div class="card">
                @if( $recipe->image )
                    <img src="{{asset('images/recipes')}}/{{$recipe->image}}" class="card-img-top" alt="{{$recipe->title}}">
                @else
                    <img src="{{asset('no-image')}}/food.jpg" class="card-img-top" alt="{{$recipe->title}}">
                @endif
                <div class="card-body">
                    <header class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">{{$recipe->title}}</h5>

                        <div class="links">
                            @can('update', $recipe)
                                <a class="text-primary" href="{{route('recipes.edit', $recipe)}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="text-danger" href="" data-toggle="modal"
                                   data-target="#recipeModal{{$recipe->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endcan
                            <!-- Modal -->
                            <div class="modal fade" id="recipeModal{{$recipe->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            The record will be deleted.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel
                                            </button>
                                            <form action="{{route('recipes.destroy', $recipe)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>

                    <p class="d-flex justify-content-between align-items-center mt-4">

                        <a href="{{route('categories.show', $recipe->category->slug)}}">
                            <span class="badge badge-success">{{$recipe->category->name}}</span>
                        </a>

                        <span>
                            <i class="far fa-clock"></i> {{$recipe->duration}} min
                        </span>
                    </p>

                    <p class="card-text">
                        @foreach($recipe->ingredients as $ingredient)
                            <span class="badge badge-warning"> {!! $ingredient !!}</span>
                        @endforeach
                    </p>

                   <p class="card-text"> {!! $recipe->procedure !!}</p>
                </div>
                    <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                        <p>
                            @<span><a class="text-info" href="{{route('users.show',
                            $recipe->user->id)}}">{{$recipe->user->name}}</a></span>
                        </p>
                        <p>
                            <time datetime="{{$recipe->created_at->toW3cString()}}" class="has-text-grey">
                                {{ $recipe->created_at->diffForHumans() }}
                            </time></p>
                    </div>
            </div>
        </div>
    </div>

    @include('comments.showComments')
@endsection
