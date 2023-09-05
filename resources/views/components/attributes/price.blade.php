<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        <input class="form-control" @if(isset($data))
            value="{{$data}}" @endif name="{{$attribute->code}}" placeholder="1.0" step="0.01" type="number"
               data-msg-max="Пожалуйста, введите значение, которое меньше или равно 1000000000000"
               min="0" max="1000000000000">
    </div>
</div>
