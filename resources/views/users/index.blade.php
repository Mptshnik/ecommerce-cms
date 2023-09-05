@php
    $title = 'Пользователи'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Все пользователи</h4>
                    </div><!--end col-->
                    <div class="col-auto align-self-center">
                        <a href="{{route('users.create')}}" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                            <span>Добавить пользователя</span>
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
                    <th>Фото профиля</th>
                    <th>Имя пользователя</th>
                    <th>Email</th>
                    <th>Дата регистрации</th>
                    <th>Дата изменения</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>
                            @if($user->profile_image)
                                <img src="{{\Illuminate\Support\Facades\Storage::url($user->profile_image)}}" height="100">
                            @else
                                <span>_</span>
                            @endif
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            {{$user->created_at->format('d.m.Y')}}
                        </td>
                        <td>
                            {{$user->updated_at->format('d.m.Y')}}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="POST" action="{{route('users.destroy', $user)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger trash"
                                                onclick="return confirm('Удалить запись?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
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
