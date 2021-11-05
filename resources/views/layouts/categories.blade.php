<section class="categories-nav mt-2">
    <h3 class="text-center text-dark">Recipes</h3>
    <nav class="mt-4">
        <ul class="categories-navigation">
            @foreach($categories as $category)
                <li>
                    <a class="text-green" href="{{route('categories.show', $category->slug)
                    }}">{{$category->name}}</a>
                </li>
             @endforeach
        </ul>
    </nav>
</section>
