@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Добавление атрибута</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-md-12">
            <form id="add-attribute-form" method="POST" action="{{route('product-attributes.store')}}">
                @csrf
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Общее
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Тип атрибута</label>
                                    <select onchange="check(this)"  id="attribute-type" name="attribute_type_value_fk" class="form-select">
                                        @foreach($attributeTypes as $type)
                                            <option value="{{$type->value}}">{{$type->label}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Наименование<span class="text-danger"> *</span></label>
                                    <input type="text" name="name" class="form-control"
                                           placeholder="Название атрибута">
                                </div>
                                <div>
                                    <label class="form-label">Код<span class="text-danger"> *</span></label>
                                    <input type="text" name="code" class="form-control"
                                           placeholder="Код атрибута">
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Валидация
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Обязательный</label>
                                    <select name="required" class="form-select">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Уникальный</label>
                                    <select name="unique" class="form-select">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                                <div id="inputValidation" style="display: none" class="mt-3">
                                    <label class="form-label">Ввод</label>
                                    <select name="input_validation" class="form-select">
                                        <option value="integer">Целое число</option>
                                        <option value="decimal">Десятичное число</option>
                                    </select>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Конфигурация
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <div>
                                    <label class="form-label">Отображается на клиенте</label>
                                    <select name="visible_on_frontend" class="form-select">
                                        <option value="1">Да</option>
                                        <option value="0">Нет</option>
                                    </select>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                    <div class="col-lg-6" id="options-card" style="display: none">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Опции
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <table id="myTable" class="table table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                                <!-- Кнопка для добавления новой строки -->
                                <button type="button" id="btn-add" class="btn btn-sm btn-primary">Добавить строку</button>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                    <a href="{{route('product-attributes.index')}}" class="btn btn-danger">
                        <span>Отмена</span>
                    </a>
                </div>
            </form>
        </div><!--end col-->
    </div> <!-- end row -->

    <script>
        var counter = 1;

        $('#btn-add').click(function() {
            var newRow = $('<tr>');
            var cols = '';

            cols += '<td><input type="text" id="options_' + counter + '"  name="options[]" class="form-control"></td>';
            cols += '<td><button type="button" class="btn btn-danger btn-remove">Удалить</button></td>';

            newRow.append(cols);
            $('#myTable').append(newRow);
            counter++;
        });

        $(document).on('click', '.btn-remove', function() {
            $(this).closest('tr').remove();
            counter--;
        });

        const select = document.getElementById('attribute-type');
        const dropdown = document.getElementById('inputValidation');

        const options = document.getElementById('options-card');

        select.addEventListener('change', function() {
            if (select.value === 'text') {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }

            if (select.value === 'select' || select.value === 'multiselect') {
                options.style.display = 'block';
            } else {
                options.style.display = 'none';
            }
        });


        $(function () {
            $("#add-attribute-form").validate({
                rules: {
                    name: "required",
                    code: "required",
                    "options[]": "required"

                },
                messages: {
                    name: "Поле обязательно",
                    code: "Поле обязательно",
                    "options[]": "Поле обязательно"
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "options[]") {
                        error.insertBefore(element.parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>
@endsection
