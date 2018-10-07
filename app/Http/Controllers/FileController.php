<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(FileRequest $request)
    {
        $path = $request->get('path');
        if (!\Storage::exists($path)) {
            abort(404);
        }
        return \Storage::response($path);
    }
}
