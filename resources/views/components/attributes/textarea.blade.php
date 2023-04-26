<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        <textarea class="form-control"
                  name="{{$attribute->code}}"
                  placeholder="{{$attribute->label}}"
                  rows="3">@if(isset($data)){{$data}}@endif</textarea>
    </div>
</div>
