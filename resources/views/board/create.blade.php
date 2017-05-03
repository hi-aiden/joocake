@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>글 생성하기</h2>
                <form method="post" action="{{ route('board.index') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label name="title" for="title">제목</label>
                        <input type="text" name="title" class="form-control" value=""/>
                    </div>
                    <div class="form-group">
                    <label name="file" for="file">파일</label>
                    <input type="file" name="thumbnail" value=""/>
                    </div>
                    <div class="form-group">
                        <label name="body" for="body">내용</label>
                        <textarea name="body" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="생성하기" class="btn btn-primary">
                    </div>
                </form>

                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                @foreach ($errors->all() as $message)
                {{ $message }}
                @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
@stop
