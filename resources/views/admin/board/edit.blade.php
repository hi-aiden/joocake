@extends('layouts.app')

@section('content')
    <script src="{{ asset('editor/ckeditor.js') }}?rand={{ filemtime(public_path('editor').'/ckeditor.js') }}"></script>
    <script src="{{ asset('editor/config.js') }}?rand={{ filemtime(public_path('editor').'/config.js') }}"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>글 수정하기</h2>
                <form method="post" action="{{ route('board.update', $board->id) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label name="title" for="title">제목</label>
                        <input type="text" name="title" class="form-control" value="{{ $board->title }}"/>
                    </div>
                    <div class="form-group">
                        <label name="file" for="file">파일</label>
                        <input type="file" name="thumbnail" value=""/>
                        <article>
                            <img src="{{ asset(Storage::url($board->thumbnail)) }}" alt="" width="20%">
                        </article>
                    </div>
                    <div class="form-group">
                        <label name="body" for="body">내용</label>
                        <textarea name="body" id="body" class="form-control">{{ $board->body }}</textarea>
                        <script>
                            var editor = CKEDITOR.replace( 'body' );
                        </script>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="수정하기" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
