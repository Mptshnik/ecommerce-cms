<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        <input class="form-control" @if(isset($data))
            value="{{$data}}" @endif name="{{$attribute->code}}" type="text">
    </div>
</div>
