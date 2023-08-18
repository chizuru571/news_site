@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="headline col-md-10 mx-auto">
                <div class="row">
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
            <h2>コメント投稿</h2>
            <form action="{{ route('news.comment') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2">コメント</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="comment" value="{{ old('comment') }}">
                    </div>
                </div>
                <input type="hidden" name="news_id" value="{{ $news->id }}">
                @csrf
                <input type="submit" class="btn btn-primary" value="コメントを投稿する">
            </form>
        </div>
    </div>
</div>  
@endsection