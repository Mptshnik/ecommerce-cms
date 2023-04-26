@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Все категории</h4>
                    </div><!--end col-->
                    <div class="col-auto align-self-center">
                        <a href="{{route('admin.categories.create')}}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                            <span>Добавить категорию</span>
                        </a>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-12">
            <table id="datatable-buttons" class="table dt-responsive nowrap"
                   style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Отображается в меню</th>
                    <th>Родительская категория</th>
                    <th>Количество товаров</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            @if($category->visible_in_menu)
                                <span class="badge rounded-pill bg-success">Да</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Нет</span>
                            @endif
                        </td>
                        <td>
                            @if($category->parentCategory)
                                {{$category->parentCategory->name}}
                            @else
                                _
                            @endif
                        </td>
                        <td>{{$category->products()->count()}}</td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="POST" action="{{route('admin.categories.destroy', $category)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger trash"
                                                onclick="return confirm('Удалить запись?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('admin.categories.edit', $category)}}" class="text-primary"><i data-feather="edit"></i></a>
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
