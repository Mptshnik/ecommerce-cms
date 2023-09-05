<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        @if($attribute->input_validation === 'decimal')
            <input class="form-control" @if(isset($data))
                value="{{$data}}" @endif name="{{$attribute->code}}" placeholder="1.0" step="0.01"
                   type="number" min="-1000000000000" max="1000000000000">
        @elseif($attribute->input_validation === 'integer')
            <input class="form-control" @if(isset($data))
                value="{{$data}}" @endif name="{{$attribute->code}}" placeholder="1" step="1"
                   type="number" min="-1000000000000" max="1000000000000">
        @else
            <input class="form-control" @if(isset($data))
                value="{{$data}}" @endif name="{{$attribute->code}}" placeholder="Введите текст" type="text">
        @endif
    </div>
</div>
