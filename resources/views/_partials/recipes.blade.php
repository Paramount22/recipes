<section class="recipes-list">
    <div class="row mt-3 justify-content-center">
        @forelse($recipes as $recipe)
            <div class="{{$loop->iteration < 3 ? 'col-md-5 col-sm-5' : 'col-lg-4 col-md-6 col-sm-6'}}">
                <div class="recipe-item mb-4">
                    <a href="{{route('recipes.show', $recipe)}}">
                        <div class="zoom-in recipe-frame">
                            @if( $recipe->image )
                                <img src="{{asset('images/recipes')}}/{{$recipe->image}}" width="350" alt="{{$recipe->title}}">
                            @else
                                <img src="{{asset('no-image')}}/food.png" alt="{{$recipe->title}}" width="350">
                            @endif
                        </div>
                    </a>

                    <div class="recipe-info">
                        <h6 class="mt-3">
                            <a href="{{route('categories.show', $recipe->category->slug)}}" class="text-green recipe-title">{{$recipe->category->name}}</a>
                        </h6>
                        <h4 >
                            <a href="{{route('recipes.show', $recipe)}}" class="text-dark">{{$recipe->title}}</a>
                        </h4>
                        <small class="mb-2">
                            <i class="far fa-clock"></i> {{$recipe->duration}} min
                        </small>

                        <a class="text-secondary" href="{{route('recipes.show', $recipe)}}#scroll-to-comments">
                            <i class="fas fa-comment"></i> {{$recipe->comments->count()}}
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="alert alert-warning" role="alert">
                No recipes!
            </div>
        @endforelse

    </div>
        <span class="d-flex justify-content-center mt-3">
            <a class="btn btn-outline-success btn-lg" href="{{route('recipes.all')}}">See all</a>
        </span>
</section>



