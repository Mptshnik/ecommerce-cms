@if ($categories->count() > 0)
    <ul style="list-style-type: none">
        @foreach ($categories as $category)
            <li>
                <div class="checkbox checkbox-primary">
                    <i data-feather="folder"></i>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                           @if($product->categories->pluck('id')->contains($category->id)) checked @endif
                           id="category{{ $category->id }}">
                    <label class="fs-5" for="category{{ $category->id }}">{{ $category->name }}</label>
                </div>
                @if ($category->childCategories->count() > 0)
                    @include('categories.partials.check-subcategories', ['categories' => $category->childCategories])
                @endif
            </li>
        @endforeach
    </ul>
@endif
