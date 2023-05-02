@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <form id="add-attribute-family-form" method="POST" action="{{route('attribute-families.store')}}">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Добавление коллекции атрибутов</h4>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
                <div class="card report-card">
                    <div class="card-header">
                        <div class="fs-5">
                            Общее
                        </div>
                    </div><!--end card-body-->
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Наименование<span class="text-danger"> *</span></label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Код<span class="text-danger"> *</span></label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Добавить</button>
                            <a href="{{route('attribute-families.index')}}" class="btn btn-danger">
                                <span>Отмена</span>
                            </a>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="page-title-box">
                    <div class="row">
                        <div class="col">
                            <h4 class="page-title">Группы атрибутов</h4>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end page-title-box-->
                <div class="row row-cols-1">
                    @foreach($groups as $group)
                        <div class="col">
                            <div class="card report-card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card-title">
                                                {{$group->name}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary btn-sm align-self-center"
                                                   data-bs-toggle="dropdown"  aria-expanded="false">Добавить атрибуты
                                            </button>
                                            <div class="dropdown-menu" >
                                                <div class="px-2" >
                                                    @foreach($attributes as $attribute)
                                                        <div class="checkbox-primary" onclick="event.stopPropagation()">
                                                            <input type="checkbox" id="cb{{$attribute->id}}" onclick="check(this)"
                                                                   value="{{$attribute->id}}">

                                                            <label>
                                                                {{$attribute->label}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    <div>
                                                        <button type="button" id="btnAddAttribute{{$group->id}}"
                                                                onclick="addAttribute(this, {{$group->id}})"
                                                                class="btn btn-primary btn-sm">Добавить
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- <button type="button" id="btnAddAttribute{{$group->id}}"
                                                     onclick="addAttribute(this, {{$group->id}})"
                                                     class="btn btn-primary btn-sm align-self-center"></button>--}}
                                        </div>
                                    </div>

                                </div><!--end card-body-->
                                <div class="card-body">
                                    <table class="table dt-responsive nowrap"
                                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Код</th>
                                            <th>Наименование</th>
                                            <th>Тип</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($group->attributes as $attribute)
                                            <tr>
                                                <td>{{$attribute->id}}</td>
                                                <td>{{$attribute->code}}</td>
                                                <td>{{$attribute->label}}</td>
                                                <td>{{$attribute->attribute_type_value_fk}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div> <!--end col-->
                    @endforeach
                </div>
            </div><!--end col-->
        </div>
    </form>
    <script>

        var checkedAttributes = []

        function check(e) {
            console.log(e.value)
            checkedAttributes.push(e.value);
        }

        function addAttribute(e, groupID) {

            var checkboxValues = [];
            $('input[type="checkbox"]').each(function() {
                if ($(this).is(':checked')) {
                    checkboxValues.push($(this).val());
                }
            });

            console.log(checkboxValues);

            console.log('{{$attributes}}');
        }

        $(function () {
            $("#add-attribute-family-form").validate({
                rules: {
                    name: "required",
                    code: "required",
                },
                messages: {
                    name: "Поле обязательно",
                    code: "Поле обязательно",
                }
            });
        });
    </script>

@endsection
