@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow mt-4">
                <div class="card-header d-flex justify-content-between">
                    <h4>Recipes</h4>
                    <div>
                        @if(request()->has('archive'))
                            <a class="btn btn-dark btn-sm" href="{{route('recipes.softDeletes')
                    }}">View all recipes</a>
                            <a class="btn btn-success btn-sm" href="{{route('recipes.restore_all')
                    }}">Restore all </a>
                        @else
                            <a class="text-dark" href="{{route('recipes.softDeletes', ['archive'])
                    }}">View archived recipes
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Email</th>
                            <th scope="col">Category</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recipes as $recipe)
                            <tr>
                                <td>{{$recipe->id}}</td>
                                <td>{{ $recipe->title  }} </td>
                                @if(isset($recipe->user))
                                    <td>{{  $recipe->user->name   }}</td>
                                    <td>{{  $recipe->user->email   }}</td>
                                    <td>{{  $recipe->category->name   }}</td>
                                @else
                                    <td class="light">Author of this recipe is deleted.</td>
                                    <td class="light">Author of this recipe is deleted.</td>
                                @endif
                                <td class="d-flex">
                                    @if($recipe->trashed())
                                        <a class="btn btn-success" href="{{route('recipes.restore',
                                        $recipe->id)
                                        }}">Restore</a>

                                        <form  action="{{route('recipes.force_delete', $recipe->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-outline-dark mx-1"
                                                    onclick="return confirm('Are you sure ?')">
                                                Delete forever
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{route('recipes.delete', $recipe->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <td class="alert alert-secondary" role="alert">
                                No posts yet!
                            </td>
                        @endforelse

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

@endsection
