@extends('admin.layouts.layout')

@section('content')
<form enctype="multipart/form-data">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Статьи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Глав</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список статей</h3>
                        </div>
                        <div class="card-body">
                            <a href="{{route('posts.create')}}" class="btn btn-primary mb-3">Добавить статью</a>
                            @if (count($posts))
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>Наименование</th>
                                            <th>Категории</th>
                                            <th>Теги</th>
                                            <th>Фото </th>
                                            <th>Дата</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts as $post)
                                        <tr>
                                            <td>{{$post->id}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>{{ $post->category->title ?? '' }}</td>
                                            <td>{{$post->tags->pluck('title')->join(', ') }}</td>
                                            <td><img src="{{ asset('uploads/'.$post->thumbnail) }}  " width="200px" height="200px"></td>
                                            <td>{{$post->created_at}}</td>
                                            <td>
                                                <a href="{{ route('posts.edit', ['post' => $post->id])}}" class="btn btn-info btn-sm float-left mr-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Подтверджение удалиния')">
                                                        <ic class="fas fa-trash-alt"></ic>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p>Постов нет</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{$posts->links()}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
</form>
@endsection