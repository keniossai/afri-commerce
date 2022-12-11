<form method="get" action="{{route('product.search')}}"
    class="header-search hs-expanded hs-rounded d-none d-md-flex input-wrapper mr-4 ml-4">
    <div class="select-box">
        <select id="category" name="category">
            <option value="">All Categories</option>
            <option value="4">Fashion</option>
            <option value="5">Furniture</option>
            <option value="6">Shoes</option>
            <option value="7">Sports</option>
            <option value="8">Games</option>
            <option value="9">Computers</option>
            <option value="10">Electronics</option>
            <option value="11">Kitchen</option>
            <option value="12">Clothing</option>
        </select>
    </div>
    <input type="text" class="form-control" name="q" id="search"
        placeholder="Search in..." required  value="{{$q}}"/>
    <button class="btn btn-search" type="submit">Search
    </button>
</form>