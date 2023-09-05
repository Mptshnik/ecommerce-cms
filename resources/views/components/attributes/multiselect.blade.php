<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        <select class="select2 form-control" multiple="multiple" name="{{$attribute->code}}[]">
            @foreach($attribute->options as $index => $option)
                <option @if(isset($data) && in_array($option, $data))
                            selected
                        @endif
                        value="{{$option}}">{{$option}}</option>
            @endforeach
        </select>
    </div>
</div>
