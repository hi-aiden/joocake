@extends('layouts.master')

@section('content')
    <h2>글 수정하기</h2>
    <form method="post" action="{{ route('post.update', $post->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="put">
        <div class="form-group">
            <label name="title" for="title">제목</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}"/>
        </div>
        <div class="form-group">
            <label name="body" for="body">내용</label>
            <textarea name="body" class="form-control">{{ $post->body }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="수정하기" class="btn btn-primary">
        </div>
    </form>
@stop
