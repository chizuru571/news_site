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
                                    <h1>{{ Str::limit($news->title, 70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="body mx-auto">{{ Str::limit($news->body, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
@endsection