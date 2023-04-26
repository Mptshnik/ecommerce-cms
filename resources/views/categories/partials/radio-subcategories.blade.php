@if ($categories->count() > 0)
    <ul style="list-style-type: none">
        @foreach ($categories as $category)
            <li>
                <div class="radio radio-primary">
                    <i data-feather="folder"></i>
                    <input type="radio" name="category_id" value="{{ $category->id }}" id="category{{ $category->id }}">
                    <label class="fs-5" for="category{{ $category->id }}">{{ $category->name }}</label>
                </div>
                @if ($category->childCategories->count() > 0)
                    @include('categories.partials.radio-subcategories', ['categories' => $category->childCategories])
                @endif
            </li>
        @endforeach
    </ul>
@endif
