@php
    $title = 'Отзывы о товарах'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Все отзывы</h4>
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
                    <th>Товар</th>
                    <th>Содержание</th>
                    <th>Автор</th>
                    <th>Время публикации</th>
                    <th>Опубликован</th>
                    <th data-orderable="false">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{$review->id}}</td>
                        <td>{{$review->product->specifications['name']}}</td>
                        <td>
                            {{$review->comment}}
                        </td>
                        <td>
                            {{$review->customer->email}}
                        </td>
                        <td>{{$review->created_at->format('d.m.Y h:i')}}</td>
                        <td>
                            @if($review->published)
                                <span class="badge rounded-pill bg-success">Да</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Нет</span>
                            @endif
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form method="POST" action="{{route('reviews.destroy', $review)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="text-danger trash"
                                                onclick="return confirm('Удалить запись?')">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-auto">
                                    <a href="{{route('reviews.show', $review)}}" class="text-primary"><i
                                            data-feather="eye"></i></a>
                                </div>
                                <div class="col-auto">
                                    @if($review->published)
                                        <a href="{{route('reviews.hide', $review)}}" class="text-success"><i
                                                data-feather="eye-off"></i></a>
                                    @else
                                        <a href="{{route('reviews.publish', $review)}}" class="text-success"><i
                                                data-feather="check"></i></a>
                                    @endif
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
