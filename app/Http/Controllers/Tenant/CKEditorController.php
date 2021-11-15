<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $fileName = storeImage($request->file('upload'), '/images/WYSIWYG');
            $url = tenant_public_path() . '/images/WYSIWYG/' . $fileName;

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $msg = 'Image successfully uploaded';

            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function browseImages()
    {
        $paths = glob(public_path() . '/tenant/' . tenant('id') . '/images/WYSIWYG/*');
        $fileNames = [];

        foreach ($paths as $path) {
            array_push($fileNames, basename($path));
        }

        $data = [
            'fileNames' => $fileNames,
        ];

        return view('layouts.snippets.WYSIWYG-image-browser')->with($data);
    }
}
