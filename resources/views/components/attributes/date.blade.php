<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        @if(isset($data))
            <input class="form-control" type="date" value="{{ old($attribute->code, $data) }}" name="{{$attribute->code}}">
        @else
            <input class="form-control" type="date" value="{{ old($attribute->code, date('Y-m-d')) }}" name="{{$attribute->code}}">
        @endif
    </div>
</div>
