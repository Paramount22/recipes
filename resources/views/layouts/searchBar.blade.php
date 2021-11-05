
<div class="search-bar mt-4">
    <form action="{{route('search')}}" method="POST" class="d-sm-inline-block form-inline  navbar-search">
        @csrf
        @method('GET')
        <div class="input-group">
            <input type="text"
                   name="search"
                   class="form-control border-1 small"
                   placeholder="Search for recipes, ingredience"
                   value="{{request('search')}}"
                   aria-label="Search"
                   aria-describedby="basic-addon2">

            <div class="input-group-append">
                <button class="btn btn-green" type="submit">
                    <i class="fas fa-search fa-sm mr-2"></i> Search
                </button>
            </div>
        </div>
    </form>
</div>

