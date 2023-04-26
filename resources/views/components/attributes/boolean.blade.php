<div class="row">
    <div class="col-auto">
        <label class="form-label">{{$attribute->label}}</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" value="1" @if(isset($data) && $data == "1")
                checked @endif name="{{$attribute->code}}">
        </div>
    </div>

</div>
