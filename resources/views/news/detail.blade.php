@extends('layouts.front')
@section('title', 'ニュース詳細')

    @section('content')
        <div class="container">
            <hr color="#c0c0c0">
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        {{-- imageに関する記述 --}}
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="image">
                                    @if ($news->image_path)
                                        <img src="{{ secure_asset('storage/image/' . $news->image_path) }}">
                                    @endif
                                </div>
                                <div class="title p-2">
                                    <h1>{{ $news->title }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="body mx-auto">{{ $news->body }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr color="#c0c0c0">
            <div class="row">
                        <div class="col-md-8 mx-auto">
                            <ul class="list-group list-group-flush ">
                                @if ($comments != NULL)
                                    @foreach ($comments as $comment)
                                        <li class="list-group-item">
                                        {{ $comment->user_id}}　|　{{ $comment->created_at->format('Y年m月d日H時i分') }}<br>
                                        {{ $comment->comment }}
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
            <div class="col-md-8 mx-auto">
                <form action="{{ route('news.detail') }}" method="post" enctype="multipart/form-data" class="p-2">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <div class="col-md-8">
                            <textarea class="form-control" name="comment" rows="5">{{ old('comment') }}</textarea>
                        </div>
                    </div>
                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                    @csrf
                    <input type="submit" class="btn btn-success" value="コメントを投稿する">
                </form>
                </div>
            </div>
          </div>
        </div>
    </div>  
    @endsection