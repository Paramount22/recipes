<div class="row mt-3">

    @forelse($recipes as $recipe)
        <div class="col-lg-4 col-md-6">
            <div class="card mb-4">
                @if( $recipe->image )
                    <img src="{{asset('images/recipes')}}/{{$recipe->image}}" class="card-img-top" alt="{{$recipe->title}}">
                @else
                    <img src="{{asset('no-image')}}/food.jpg" class="card-img-top" alt="{{$recipe->title}}">
                @endif
                <div class="card-body">
                    <div class="header d-flex justify-content-between">
                        <h5 class="card-title">{{$recipe->title}}</h5>
                        <a href="{{route('categories.show', $recipe->category->slug)}}">
                            <span class="badge badge-success">{{$recipe->category->name}}</span>
                        </a>
                    </div>

                    <p class="d-flex justify-content-between align-items-center mt-4">
                        @if(! request()->has('view_deleted'))
                            <a href="{{route('recipes.show', $recipe)}}" class="btn btn-outline-info btn-sm">Read
                                more</a>

                            <a class="text-dark" href="{{route('recipes.show', $recipe)}}#comments">
                                <i class="fas fa-comment"></i> {{$recipe->comments->count()}}
                            </a>
                        @endif




                    </p>
                    @if(request()->has('view_deleted'))
                        <a class="btn btn-sm btn-primary" href="{{route('recipes.restore', $recipe)
                        }}">Restore</a>
                    @endif
                </div>
            </div>
        </div>

    @empty
        <p>
            No recipes!
        </p>
    @endforelse
</div>
