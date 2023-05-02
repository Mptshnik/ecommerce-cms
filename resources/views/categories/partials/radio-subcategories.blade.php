@if ($categories->count() > 0)
    <ul style="list-style-type: none">
        @foreach ($categories as $itemCategory)
            @if(isset($category) && $itemCategory->id == $category->id)
            @else
                <li>
                    <div class="radio radio-primary">
                        <i data-feather="folder"></i>
                        <input @if(isset($category) && $itemCategory->id == $category->category_id) checked @endif
                        type="radio" name="category_id" value="{{ $itemCategory->id }}"
                               id="category{{ $itemCategory->id }}">
                        <label class="fs-5" for="category{{ $itemCategory->id }}">{{ $itemCategory->name }}</label>
                    </div>
                    @if ($itemCategory->childCategories->count() > 0)
                        @include('categories.partials.radio-subcategories', ['categories' => $itemCategory->childCategories])
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
@endif
