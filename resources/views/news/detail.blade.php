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
    <hr color="#c0c0c0">
        <div class="headline col-md-10 mx-auto">
            <div class="row">
                <div class="col-md-6">
                    <div class="caption mx-auto">
                        <div class="title p-2">
                                    <h1>コメント</h1>
                                </div>
                    </div>
                </div>
            </div>
        </div>
            <hr color="#c0c0c0">
            コメントコメント
            <hr color="#c0c0c0">
            コメントコメント
            <hr color="#c0c0c0">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="  5">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="コメントする">
                </form>
    </div>
@endsection