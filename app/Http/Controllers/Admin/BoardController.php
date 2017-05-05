<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use Validator;
use Storage;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::orderBy('created_at', 'desc')->paginate(10);

        return view('board.index', compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $board = new Board;

        $validator = Validator::make($data = $request->all(), Board::$rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');

            $newFileName = time().'-'.$thumbnail->getClientOriginalName();

            $thumbnail->move(storage_path('app/public'), $newFileName);
            $board->thumbnail = $newFileName;
        }

        $board->title = $request->input('title');
        $board->body = $request->input('body');

        $board->save();


        return redirect()->route('board.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $board = Board::findOrFail($id);

        return view('board.show', compact('board'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $board = Board::find($id);
        return view('board.edit', compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $board = Board::findOrFail($id);

        $validator = Validator::make($data = $request->all(), Board::$rules);

        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');

            if ($thumbnail->isValid()) {
                if(substr($thumbnail->getMimeType(), 0, 5) == 'image') {
                    $newFileName = md5(time()) .".". $thumbnail->getClientOriginalExtension();
                    $thumbnail->move(storage_path('app/public'), $newFileName);

                    @unlink(storage_path("app/public/{$board->thumbnail}"));

                    $board->thumbnail = $newFileName;
                }
            }
        }

        $board->title = $request->input('title');
        $board->body = $request->input('body');

        $board->save();

        return redirect()->route("board.show", $board->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $board = Board::findOrFail($id);

        @unlink(storage_path("app/public/{$board->thumbnail}"));

        Board::destroy($id);
        return redirect()->route('board.index');
    }
}
