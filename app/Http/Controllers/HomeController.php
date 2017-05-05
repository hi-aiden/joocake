<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // https://github.com/ixudra/curl
/*
        $params = array(
            'blogId' => 'joocake',
            'currentPage' => 1,
            'categoryNo' => 17,
            'countPerPage' => 30
        );

        $response = Curl::to('http://blog.naver.com/PostTitleListAsync.nhn')
            ->withData($params)
         //   ->asJson()
            ->get();

        $response = strip_tags($response);
        $response = iconv("cp949", "utf-8", $response);
        $response = str_replace("\n","", $response);
        $response = str_replace("\r","", $response);
        $response = str_replace("\n\r","", $response);

        print_r(json_decode(urldecode($response), true));*/
//        return view('home');

        $category = Category::orderBy('created_at', 'desc')->paginate(10);

        print_r($category);
    }
}
