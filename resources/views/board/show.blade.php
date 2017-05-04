@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $board->title }}</h1>

                <article>
                    {{ $board->body }}
                </article>
                <article>
                    <img src="{{ asset(Storage::url($board->thumbnail)) }}" alt="">
                </article>

                <h3>
                    <a href="{{ route('board.edit', $board->id) }}" class="btn btn-primary"> 글 수정하기 </a>
                    <form method="post" action="{{ route('board.destroy', $board->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-primary" value=""/>글 삭제하기</button>

                    </form>

                    <a href="{{ route('board.index') }}" class="btn btn-primary"> 목록으로 </a>
                </h3>
            </div>
        </div>
    </div>
@endsection