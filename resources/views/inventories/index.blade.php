@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Склады</h4>
                    </div><!--end col-->
                    <div class="col-auto align-self-center">
                        <a href="{{route('admin.inventories.create')}}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                            <span>Добавить склад</span>
                        </a>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-12">
            <table id="inventories-table" class="table dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Код</th>
                    <th>Наименование</th>
                    <th>Статус</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>{{$inventory->id}}</td>
                        <td>{{$inventory->code}}</td>
                        <td>{{$inventory->name}}</td>
                        <td>
                            @if($inventory->status)
                                <span class="badge rounded-pill bg-success">Активен</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Не активен</span>
                            @endif
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="POST" action="{{route('admin.inventories.destroy', $inventory)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger trash"
                                                onclick="return confirm('Удалить запись?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('admin.inventories.edit', $inventory)}}" class="text-primary"><i data-feather="edit"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
