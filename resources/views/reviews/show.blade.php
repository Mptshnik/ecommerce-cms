@php
    $title = 'Просмотр отзыва о товаре'
@endphp
@extends('layouts.main')
@section('content')
    @include('components.toastr.toast')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Отзыв о товаре</h4>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div><!--end row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card report-card">
                <div class="card-header">
                    <div class="fs-5">
                        Содержание отзыва
                    </div>
                </div><!--end card-body-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <label class="fs-5">Комментарий: </label>
                                {{$review->comment}}
                            </div>
                            <div>
                                <label class="fs-5">Достоинства: </label>
                                {{$review->advantages ?? '_'}}
                            </div>
                            <div>
                                <label class="fs-5">Недостатки: </label>
                                {{$review->disadvantages ?? '_'}}
                            </div>
                            <div>
                                <label class="fs-5">Рейтинг: </label>
                                {{$review->rating}}
                            </div>
                            <div class="mt-3">
                                <label class="fs-5">Товар: </label>
                                {{$review->product->specifications['name']}}
                            </div>
                            <div>
                                <label class="fs-5">Автор: </label>
                                {{$review->customer->email}}
                            </div>
                            <div>
                                <label class="fs-5">Опубликован: </label>
                                @if($review->published)
                                    <span class="badge rounded-pill bg-success">Да</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Нет</span>
                                @endif
                            </div>
                            <div>
                                <label class="fs-5">Время публикации: </label>
                                {{$review->created_at->format('d.m.Y h:i')}}
                            </div>
                            <div>
                                <label class="fs-5">Время изменения: </label>
                                {{$review->updated_at->format('d.m.Y h:i')}}
                            </div>
                            <div class="row mt-3">
                                <div class="col-auto">
                                    @if($review->published)
                                        <a href="{{route('reviews.hide', $review)}}" class="btn btn-warning btn-sm">
                                            <span>Скрыть</span>
                                        </a>
                                    @else
                                        <a href="{{route('reviews.publish', $review)}}"
                                           class="btn btn-success btn-sm">
                                            <span>Опубликовать</span>
                                        </a>
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <form method="POST" action="{{route('reviews.destroy', $review)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Удалить запись?')">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div> <!-- end row -->
@endsection
