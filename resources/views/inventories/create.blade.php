@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Добавление склада</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-md-12">
            <form id="add-inventory-form" method="POST" action="{{route('inventories.store')}}" class="mb-3">
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
                                    <label class="form-label">Наименование<span class="text-danger"> *</span></label>
                                    <input type="text" id="nameInput" name="name" class="form-control"
                                           placeholder="Название">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Код<span class="text-danger"> *</span></label>
                                    <input type="text" name="code" class="form-control"
                                           placeholder="Код">
                                </div>
                                <div>
                                    <label class="form-label">Статус</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1"
                                               name="status">
                                    </div>
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Контактная информация
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">ФИО<span class="text-danger"> *</span></label>
                                    <input type="text" name="full_name" class="form-control"
                                           placeholder="Иванов Иван Иванович">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email<span class="text-danger"> *</span></label>
                                    <input type="email" name=email class="form-control"
                                           placeholder="email@mail.ru">
                                </div>
                                <div>
                                    <label class="form-label">Номер телефона<span class="text-danger"> *</span></label>
                                    <input type="text" name="phone_number" class="form-control"
                                           placeholder="+79775486988">
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                    <div class="col-lg-6">
                        <div class="card report-card">
                            <div class="card-header">
                                <div class="fs-5">
                                    Адрес
                                </div>
                            </div><!--end card-body-->
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Страна<span class="text-danger"> *</span></label>
                                    <input type="text" name="country" class="form-control"
                                           placeholder="Россия">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Регион<span class="text-danger"> *</span></label>
                                    <input type="text" name="region" class="form-control"
                                           placeholder="Московская область">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Город<span class="text-danger"> *</span></label>
                                    <input type="text" name="city" class="form-control"
                                           placeholder="Москва">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Улица<span class="text-danger"> *</span></label>
                                    <input type="text" name="street" class="form-control"
                                           placeholder="ул. Нежинская">
                                </div>
                                <div>
                                    <label class="form-label">Дом, строение, корпус<span class="text-danger"> *</span></label>
                                    <input type="text" name="house_number" class="form-control"
                                           placeholder="д. 7">
                                </div>
                                <div>
                                    <label class="form-label">Почтовый индекс<span class="text-danger"> *</span></label>
                                    <input type="text" name="postal_code" class="form-control"
                                           placeholder="141200">
                                </div>
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div> <!--end col-->
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
                <a href="{{route('inventories.index')}}" class="btn btn-danger">
                    <span>Отмена</span>
                </a>
            </form>
        </div><!--end col-->
    </div> <!-- end row -->

    <script>
        $(function () {
            $("#add-inventory-form").validate({
                rules: {
                    name: "required",
                    code: "required",
                    full_name: "required",
                    email: "required",
                    phone_number: "required",
                    country: "required",
                    region: "required",
                    city: "required",
                    street: "required",
                    house_number: "required",
                    postal_code: "required"
                },
                messages: {
                    name: "Поле обязательно",
                    code: "Поле обязательно",
                    full_name: "Поле обязательно",
                    email: "Поле обязательно",
                    phone_number: "Поле обязательно",
                    country: "Поле обязательно",
                    region: "Поле обязательно",
                    city: "Поле обязательно",
                    street: "Поле обязательно",
                    house_number: "Поле обязательно",
                    postal_code: "Поле обязательно",
                }
            });
        });
    </script>
@endsection
