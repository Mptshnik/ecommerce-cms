<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        <select class="form-select" name="{{$attribute->code}}">
            @foreach($attribute->options as $option)
                <option @if(isset($data) && $data === $option)
                             selected
                        @endif
                value="{{$option}}">{{$option}}</option>
            @endforeach
        </select>
    </div>
</div>
