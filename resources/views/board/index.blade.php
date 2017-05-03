@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>All Posts</h1>
            <ul class="list-group">
                @foreach($boards as $board)
                    <li class="list-group-item">
                        <a href="{{ route("board.show", $board->id) }}">{{ $board->title }}</a>
                    </li>
                @endforeach
            </ul>

            {{--{!! $boards->render() !!}--}}

            <h3>
                <a href="{{ route('board.create') }}" class="btn btn-primary"> 글 작성하기 </a>
            </h3>
        </div>
    </div>
@stop
