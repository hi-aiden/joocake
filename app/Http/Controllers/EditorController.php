<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class EditorController extends Controller
{
    /**
     * uploadImage a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        $CKEditor = $request->input('CKEditor');
        $funcNum = $request->input('CKEditorFuncNum');
        $message = $url = '';

        if($request->hasFile('upload'))
        {
            $file = $request->file('upload');
            if ($file->isValid()) {
                if(substr($file->getMimeType(), 0, 5) == 'image') {
                    $filename = md5($file->getClientOriginalName()) .".". $file->getClientOriginalExtension();
                    $file->move(storage_path('app/public/attach_files'), $filename);
                    $url = asset(Storage::url("attach_files/".$filename));
                } else {
                    $message = '이미지 파일만 업로드 가능합니다.';
                }
            } else {
                $message = '파일을 업로드하는 중에 오류가 발생했습니다.';
            }
        } else {
            $message = '업로드 된 파일이 없습니다.';
        }

        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}
