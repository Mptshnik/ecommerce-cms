<div class="row">
    <div class="mb-3">
        <label class="form-label">{{$attribute->label}}
            @if($attribute->required)
                <span class="text-danger"> *</span>
            @endif
        </label>
        @if(isset($data))
            <input type="text" value="{{ old($attribute->code, $data) }}"
                   class="form-control min-date" name="{{$attribute->code}}"
                   placeholder="Выберите дату и время" >
        @else
            <input type="text" class="form-control min-date" name="{{$attribute->code}}"
                   placeholder="Выберите дату и время" >
        @endif
    </div>
</div>

