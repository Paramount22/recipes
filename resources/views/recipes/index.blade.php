@extends('layouts.app')

@section('content')
    @include('_partials.messages')
    <div class="d-flex justify-content-between align-items-center">
        <p>
            Recipes: {{$count}}
        </p>
            @can('has_access')
                <div class="mt-2 mb-2">
                    @if(request()->has('view_deleted'))
                        <a class="btn btn-sm btn-outline-info" href="{{route('recipes.index')
                            }}">View all recipes</a>
                        <a class="btn btn-sm btn-outline-success" href="{{route('recipes.restore_all')
                            }}">Restore all </a>
                    @else
                        <a class="btn btn-sm btn-outline-danger" href="{{route('recipes.index', ['view_deleted' => ['DeletedRecords']])
                            }}">View deleted recipes</a>
                    @endif
                </div>
            @endcan
        <span>
           <a href="{{route('recipes.create')}}" class="btn btn-outline-info">
             <i class="fas fa-plus-square"></i>  New recipe
           </a>
        </span>
    </div>

    @include('_partials.recipes')
    {{ $recipes->links() }}
@endsection
